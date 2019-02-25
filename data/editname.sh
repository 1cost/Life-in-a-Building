#!/bin/bash

for fname in $PWD/*
do
  mv ${fname##*/} ${PWD##*/}_${fname##*/}
done
