# To-do-list

# Description
This project uses the PHP framework called Symfony along with react to produce a web appliation that can allow a user to keep track of their to-do tasks along with
the ability to add tasks whenever a user finds a new task to do or delete tasks if the user has completed one. It works by connecting to a database which will save
tasks that the user has entered, 


# How-to-install
first install scoop to be able to install symfony
```
iwr -useb get.scoop.sh | iex
```
```
scoop install symfony-cli
```
Next install composer to be able to install encore click [here](https://getcomposer.org/download/)
```
composer require symfony/webpack-encore-bundle
```
Afterwards please download yarn, react and material ui
```
npm install yarn
```
```
yarn add react react-dom prop-types
```
```
yarn add @material-ui/core
```
```
yarn add @material-ui/icons
```


# How-to-run
uncomment ``` /.enableReactPreset() ``` in webpack.config.js run ``` yarn encore dev --watch ``` and run ``` symfony server:start ```
