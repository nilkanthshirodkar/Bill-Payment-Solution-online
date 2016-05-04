-- phpMyAdmin SQL Dump
-- version 2.8.0.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 17, 2013 at 03:37 PM
-- Server version: 5.0.20
-- PHP Version: 5.1.2
-- 
-- Database: `users`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `basic`
-- 

CREATE TABLE `basic` (
  `uid` int(11) NOT NULL auto_increment,
  `name` varchar(30) collate latin1_general_ci NOT NULL,
  `address` text collate latin1_general_ci NOT NULL,
  `contact` varchar(11) collate latin1_general_ci NOT NULL,
  `mobile` varchar(11) collate latin1_general_ci NOT NULL,
  `email` varchar(50) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `login`
-- 

CREATE TABLE `login` (
  `uid` int(11) NOT NULL auto_increment,
  `email` varchar(50) collate latin1_general_ci NOT NULL,
  `pass` varchar(100) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `temp`
-- 

CREATE TABLE `temp` (
  `uid` int(11) NOT NULL auto_increment,
  `email` varchar(50) collate latin1_general_ci NOT NULL,
  `pass` varchar(100) collate latin1_general_ci NOT NULL,
  `hash` varchar(100) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;
