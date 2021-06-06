# Gamification-Permissions Plugin

Allows users to automatically grant permissions when they win badges.

## Installation

```terminal
composer require sunlab/wn-gamification-permissions-plugin
```

## Requirements

This plugin relies on [SunLab.Permissions](https://github.com/sunlabdev/wn-permissions-plugin)
and [SunLab.Gamification](https://github.com/sunlabdev/wn-gamification-plugin) plugins.

## Creating Permissions

All you need to do is to:
- Create some permission(s) in [SunLab.Permissions](https://github.com/sunlabdev/wn-permissions-plugin).
- Create some badge(s) in [SunLab.Gamification](https://github.com/sunlabdev/wn-gamification-plugin).
- Create relationship from badge(s) to permission(s) using the backend settings controller.
