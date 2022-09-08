#!/bin/bash

GREEN='\033[0;32m'
RED='\033[0;31m'
RESET='\033[0m'

TMP_DIR="./var/tmp"
SMP_DIR="./samples"
SRC_DIR="./src"

function execute() {

    mkdir -p ${TMP_DIR}/task-"$1"-tests/ &&
        cat ${SMP_DIR}/task-"$1"-tests/"$2" | php ${SRC_DIR}/solution-"$1".php >${TMP_DIR}/task-"$1"-tests/"$2".answer &&
        tr -d '\015' <${SMP_DIR}/task-"$1"-tests/"$2".a >${TMP_DIR}/task-"$1"-tests/"$2".reference &&
        diff ${TMP_DIR}/task-"$1"-tests/"$2".answer ${TMP_DIR}/task-"$1"-tests/"$2".reference &&
        printf "%b" "${GREEN}${1}-${2} passed${RESET}\n" || printf "%b" "\n${RED}${1}-${2} failed${RESET}\n"
}

if [ -z "$1" ]; then
    printf "%b" "\n${RED}Missing parameter task index${RESET}\n"
    exit 1
fi

if [ -z "$2" ]; then
    for f in ${SMP_DIR}/task-"$1"-tests/*; do
        filename="${f##.*/}"

        if [[ $filename == *.a ]]; then
            continue
        fi

        printf "%b" "\n----------------\n\n"
        # shellcheck disable=SC2086
        time execute "$1" $filename
    done

    exit 0
fi

printf "%b" "\n"
time execute "$1" "$2"
