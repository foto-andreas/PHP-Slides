#!/bin/bash

mkdir -p thumbs
if [[ "$*" == --replace ]]; then
  rm -f thumbs/*
fi

for i in *.{jpg,jpeg,png,JPG,JPEG,PNG}; do
  if [ -f $i ]; then
    if [ ! -f thumbs/$i ]; then
      echo creating thumbnail for $i...
      convert -geometry 240x240 $i thumbs/$i
    else
      echo thumbnail for $i exists
    fi
  fi
done

for i in *.{mp4,MP4}; do
  if [ -f $i ]; then
    if [ ! -f thumbs/$i.jpg ]; then
      echo creating thumbnail for $i...
      convert -geometry 240x240 $i[10] thumbs/$i.jpg
    else
      echo thumbnail for $i exists
    fi
  fi
done
