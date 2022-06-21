# Changelog

All notable changes to `ohdear-php-sdk` will be documented in this file

## 3.4.4 - 2022-06-21

- add `summary` to `Check`

## 3.4.2 - 2022-03-17

- update to enforce certificate verification (#27)
- fix Composer install for tests (#28)

## 3.4.1 - 2022-03-01

- allow `StatusPageUpdate::$text` to be nullable (#25)

## 3.4.0 - 2022-02-23

- add endpoints and resources for app health checks (#24)

## 3.3.0 - 2021-11-05

- add support for upcoming Dns endpoints

## 3.2.1 - 2021-08-12

- replace `timeFrame` with `groupBy` when retrieving performance records

## 3.2.0 - 2021-08-11

- use new performance record format

## 3.1.3 - 2021-05-15

- add sorting parameter to performance records method (#21)

## 3.1.2 - 2021-03-02

- make description optional in cron checks

## 3.1.1 - 2021-03-02

- make description optional in cron checks

## 3.1.0 - 2021-02-09

- add status page updates API (#19)

## 3.0.4 - 2021-01-09

- more fixes around performance records

## 3.0.3 - 2021-01-09

- fix transforming `PerformanceRecord` objects (#17)

## 3.0.2 - 2020-11-30

- add support for PHP 8

## 3.0.1 - 2020-08-21

- add support for Guzzle 7

## 3.0.0 - 2020-07-09

- add support for cron sync
- drop support for PHP 7.3 and below

## 2.0.0 - 2020-06-10

This release introduces 2 breaking changes in the way the dates are passed for these functions:

- `performanceRecords`
- `createSiteMaintenance`

## 1.7.0 - 2019-01-07

- add start and stop maintenance endpoints

## 1.6.0 - 2019-09-12

- add status pages

## 1.5.1 - 2018-09-20

- make api resources cacheable

## 1.5.0 - 2018-09-18

- add `label` to check

## 1.4.2 - 2018-09-18

- fix certificate health endpoint

## 1.4.1 - 2018-09-13

- fix trait name

## 1.4.0 - 2018-09-12

**THIS VERSION CONTAINS A BREAKING BUG, DO NOT USE**

- add `certificate-health` endpoint

## 1.3.1 - 2018-09-10

- fix hostname

## 1.3.0 - 2018-09-10

- add uptime and downtime methods

## 1.2.0 - 2018-09-01

- add `siteByUrl`

## 1.1.1 - 2018-08-29

- rename `apiKey` to `apiToken`

## 1.1.0 - 2018-08-29

- add methods to retrieve mixed content and broken links

## 1.0.1 - 2018-05-08

- fix bug where a successful response would not be recognized as such

## 1.0.0 - 2018-01-18

- initial release
