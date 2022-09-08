#!/bin/bash

GREEN='\033[0;32m'
RED='\033[0;31m'
RESET='\033[0m'

TMP_DIR="./var/tmp"
SMP_DIR="./samples"
SRC_DIR="./src"

((PASSED = 0))
((FAILED = 0))

function execute() {
    REFERENCE="${TMP_DIR}/task-${1}/${2}.reference"
    ANSWER="${TMP_DIR}/task-${1}/${2}.answer"

    mkdir -p "${TMP_DIR}/task-${1}/"
    php "${SRC_DIR}/solution-${1}.php" <"${SMP_DIR}/task-${1}/${2}" >"${ANSWER}"
    tr -d '\015' <"${SMP_DIR}/task-${1}/${2}.a" >"${REFERENCE}"

    if diff -c "${ANSWER}" "${REFERENCE}" >"${TMP_DIR}/task-${1}/${2}.diff"; then
        printf "%b" "${GREEN}${1}-${2} passed${RESET}\n"
        ((PASSED++))
    else
        printf "%b" "${RED}${1}-${2} failed${RESET}\n"
        ((FAILED++))
    fi
}

if [ -z "${1}" ]; then
    printf "%b" "\n${RED}Missing parameter task index${RESET}\n"
    exit 1
fi

if [ -z "${2}" ]; then
    for f in "${SMP_DIR}"/task-"${1}"/*; do
        filename="${f##.*/}"

        if ! [[ "${filename}" == *.a ]]; then
            printf "%b" "\n----------------\n\n"
            time execute "${1}" "${filename}"
        fi
    done

    printf "%b" "\n----------------\n"
    printf "%b" "\nTotal:  $((PASSED + FAILED))"
    printf "%b" "\n${GREEN}Passed: ${PASSED}${RESET}"
    printf "%b" "\n${RED}Failed: ${FAILED}${RESET}\n"

    exit 0
fi

printf "%b" "\n"
time execute "${1}" "${2}"
