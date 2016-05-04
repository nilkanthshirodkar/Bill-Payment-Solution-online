-- phpMyAdmin SQL Dump
-- version 2.8.0.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 17, 2013 at 03:36 PM
-- Server version: 5.0.20
-- PHP Version: 5.1.2
-- 
-- Database: `electric`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `bill_status`
-- 

CREATE TABLE `bill_status` (
  `bid` double NOT NULL auto_increment,
  `status` varchar(12) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `bill_unit`
-- 

CREATE TABLE `bill_unit` (
  `bid` double NOT NULL auto_increment,
  `cycle_no` varchar(20) collate latin1_general_ci NOT NULL,
  `unit` int(11) NOT NULL,
  PRIMARY KEY  (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `division`
-- 

CREATE TABLE `division` (
  `circle` varchar(10) collate latin1_general_ci NOT NULL,
  `divison` varchar(10) collate latin1_general_ci NOT NULL,
  `sub` varchar(10) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`circle`,`divison`,`sub`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

-- 
-- Table structure for table `meter_reading`
-- 

CREATE TABLE `meter_reading` (
  `cycle_no` varchar(20) collate latin1_general_ci NOT NULL,
  `reading` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`cycle_no`,`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

-- 
-- Table structure for table `other_tarrif`
-- 

CREATE TABLE `other_tarrif` (
  `fppca` float NOT NULL,
  `meter_rent` float NOT NULL,
  `duty` float NOT NULL,
  `mf` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

-- 
-- Table structure for table `payment`
-- 

CREATE TABLE `payment` (
  `uid` double NOT NULL,
  `cycle_no` varchar(20) collate latin1_general_ci NOT NULL,
  `method` varchar(15) collate latin1_general_ci NOT NULL,
  `bid` double NOT NULL,
  PRIMARY KEY  (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

-- 
-- Table structure for table `system_user`
-- 

CREATE TABLE `system_user` (
  `uid` double NOT NULL auto_increment,
  `superior` double NOT NULL,
  `sdiv` varchar(10) collate latin1_general_ci NOT NULL,
  `name` varchar(20) collate latin1_general_ci NOT NULL,
  `username` varchar(20) collate latin1_general_ci NOT NULL,
  `pass` varchar(75) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tarrif`
-- 

CREATE TABLE `tarrif` (
  `catagory` varchar(30) collate latin1_general_ci NOT NULL,
  `type` varchar(30) collate latin1_general_ci NOT NULL,
  `fixed` float NOT NULL,
  `at` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE `user` (
  `uid` double NOT NULL,
  `sdiv` decimal(10,0) NOT NULL,
  `cycle_no` varchar(20) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`cycle_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
