#!/bin/bash

find ./${3} -type f -name "${1}*" | while read FILE ; do
    newfile="$(echo ${FILE} |sed -e 's/'"${1}"'/'"${2}"'/g')" ;
    mv "${FILE}" "${newfile}" ;
done 

find ./${3} -type f -name "*${1}*" | while read FILE ; do
    newfile="$(echo ${FILE} |sed -e 's/'"${1}"'/'"${2}"'/g')" ;
    mv "${FILE}" "${newfile}" ;
done

find ./${3} -type f -name "*${1}" | while read FILE ; do
    newfile="$(echo ${FILE} |sed -e 's/'"${1}"'/'"${2}"'/g')" ;
    mv "${FILE}" "${newfile}" ;
done