# init.sql

create database wbc_db;
use wbc_db;
source /db/mvc_dump.sql;

create user wbc_admin identified by "wbc.admin";
grant all privileges on wbc_db.* to wbc_admin@'%';

-- create database akcom_db;
-- use akcom_db;
-- source /db/mvc_dump.sql;

-- create user akcom_admin identified by "akcom.admin";
-- grant all privileges on akcom_db.* to akcom_admin@'%';
