#!/bin/bash

mkdir -p thumbs
if [[ "$*" == --replace ]]; then
  rm -f thumbs/*
fi

for i in *.jpg; do
  if [ ! -f thumbs/$i ]; then
    echo creating thumbnail for $i...
    convert -geometry 240x240 $i thumbs/$i
  else
    echo thumbnail for $i exists
  fi
done

