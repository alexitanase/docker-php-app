arguments="$@"


images=$default_images
echo "Building $project_name images ($images)"

last_version=$(docker image ls | grep $project_name | awk -F ' ' '{print $2}' | egrep -i '^[0-9]+\.[0-9]+\.[0-9]+' | sort -r --version-sort | head -n1)
echo "Last version: $last_version"

major=0
minor=0
build=0

# break down the version number into it's components
regex="([0-9]+).([0-9]+).([0-9]+)"
if [[ $last_version =~ $regex ]]; then
  major="${BASH_REMATCH[1]}"
  minor="${BASH_REMATCH[2]}"
  build="${BASH_REMATCH[3]}"
fi

build=$(echo $build + 1 | bc)

new_version=${major}.${minor}.${build}

echo "New version? (Default $new_version)"
# shellcheck disable=SC2162
read version

if [ -z "${version}" ]
then
  version=$new_version
fi

export version=$version

docker-compose build
docker-compose push

for image in $images
do
  image_name=$project_name-$image
	echo "Building ${image} v${version}"

	# shellcheck disable=SC2181
	echo "Pushing $image_name to registry"
	#docker tag "$registry_url/$image_name" "$registry_url/$image_name:$version"
	docker tag "$registry_url/$image_name:$version" "$registry_url/$image_name:latest"
	docker push "$registry_url/$image_name:$version"
	echo "Done $image_name"
	sleep 1
done

echo "Executing propel migrate"
echo docker run -e "DATABASE_DSN=\"$DATABASE_DSN\"" -e "DATABASE_USER=$DATABASE_USER" -e "DATABASE_PASS=$DATABASE_PASS" "$registry_url/$propel_image:$version" vendor/bin/propel migrate
docker run -e DATABASE_DSN -e DATABASE_USER -e DATABASE_PASS $registry_url/$propel_image:$version vendor/bin/propel migrate

echo "Updating the swarm"
docker stack deploy -c ./docker-compose.yml $project_name