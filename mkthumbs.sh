#!/bin/bash

mkdir -p thumbs

for i in *.jpg; do
  convert -geometry 100x100 $i thumbs/$i
done

