#!/bin/bash

mkdir -p ./var/tmp/task-"$1"-tests/ &&
tr -d '\015' < ./samples/task-"$1"-tests/"$2" > ./var/tmp/task-"$1"-tests/"$2"LF &&
cat ./var/tmp/task-"$1"-tests/"$2"LF | php ./src/solution-"$1".php > ./var/tmp/task-"$1"-tests/"$2"LF.answer &&
tr -d '\015' < ./samples/task-"$1"-tests/"$2".a > ./var/tmp/task-"$1"-tests/"$2"LF.reference &&
diff ./var/tmp/task-"$1"-tests/"$2"LF.answer ./var/tmp/task-"$1"-tests/"$2"LF.reference &&
echo "Test ${1}-${2} completed successfully!"
