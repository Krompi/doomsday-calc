#!/bin/bash

clear
echo "******************************************************"
echo "*                                                    *"
echo "*  Das Skript wechselt die Remote-Adresse und        *"
echo "*  entfernt die Historie des Template-Repo           *"
echo "*                                                    *"
echo "******************************************************"
echo ""


echo "Adresse der neuen Remote-Adresse, [ENTER] zum Bestätigen:"
read remote

status=$(curl --head --silent ${remote} | head -n 1)

if echo "$status" | grep -q 200
    then
        git remote set-url origin ${remote}
        git branch tmp_branch $(echo "init from Laravel-Template" | git commit-tree HEAD^{tree})
        git checkout tmp_branch
        git branch -D master && git branch -m master
        git push --set-upstream origin master
fi