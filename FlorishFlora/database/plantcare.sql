-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3310
-- Generation Time: Nov 25, 2023 at 01:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plantcare`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ListOrdersByNursery` (IN `nursery_name` VARCHAR(255))   BEGIN
    SELECT o.order_id, u.fname AS customer_firstname, u.lname AS customer_lastname, o.invoice_number, o.date, o.status,
           SUM(p.price * op.quantity) AS total_amount
    FROM orders o
    JOIN user_table u ON o.cust_id = u.cust_id
    JOIN order_plants op ON o.order_id = op.order_id
    JOIN plants p ON op.plant_id = p.plant_id
    WHERE p.n_name = nursery_name
    GROUP BY o.order_id;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `totalsales` (`nursery_name` VARCHAR(255)) RETURNS INT(11)  BEGIN
declare total integer; 
select SUM(p.price*op.quantity) into total from order_plants op join plants p on op.plant_id = p.plant_id where n_name=nursery_name; 
IF total IS NULL THEN
  SET total = 0; 
 END IF; 
return total; 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`) VALUES
(1, 'chetana', 'chetana@gmail.com', '$2y$10$EwN5p/rTcuffjkhfX0XD..8OsNMpaqz/kt.g4iPPVRFl5u2E95dVG'),
(3, 'nisarga', 'nisargakunder03@gmail.com', '$2y$10$MGLrGvQ/IGCj23qv.HgsBu/v.4TsMhC0sxhdqJHfLW3NY6VU1wfyq');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `cart_id` int(11) NOT NULL,
  `plant_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cust_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'Fruits'),
(2, 'Garden'),
(3, 'Decorative'),
(4, 'Vegetables'),
(5, 'Medicinal'),
(6, 'Vastu'),
(7, 'Seeds');

-- --------------------------------------------------------

--
-- Table structure for table `nursery`
--

CREATE TABLE `nursery` (
  `nursery_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nursery`
--

INSERT INTO `nursery` (`nursery_id`, `name`, `email`, `password`, `location`) VALUES
(1, 'Mama Earth', 'mamaearth@gmail.com', '$2y$10$NacdqYjeZubQxuTlNSrNpO8oLtIpBqc3BFuUt8swT68ZCX.KfXfei', 'bnglr'),
(2, 'Saim Garden', 'saimgarden@gmail.com', '$2y$10$QvAEjsst8i6TF.XWYuw9RORS7ZpRRsMmO6BrP3waAszOBFSU4ekPq', 'Udupi'),
(3, 'Aiden Gardens', 'aiden@gmail.com', '$2y$10$fajJ3iNlN1Q8M460ocnJ3eJLicrx3Hf6IWcVtmSzgvf/UjaXkXLSq', 'Mangalore'),
(4, 'Somnia Nursery', 'somnia@gmail.com', '$2y$10$x9UyP4HLhRZvYJ5gPnxX/uhNfrmmjzSaXPWUjZxpUGEETHWWIOyy.', 'Kumta'),
(5, 'Dream Nursery', 'dream@gmail.com', '$2y$10$SpE7fKt1hhy2TGoESkRmF.19/KTIeoqZakJgKHqwfEjeoiv/HbqOe', 'Madanpalli');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `amount_due` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cust_id`, `invoice_number`, `date`, `status`, `amount_due`) VALUES
(1, 5, 628528132, '2023-11-09', 'complete', 460),
(2, 5, 1960135222, '2023-11-11', 'complete', 441),
(3, 4, 349023378, '2023-11-15', 'complete', 320),
(5, 9, 423608925, '2023-11-25', 'complete', 430),
(6, 5, 189280654, '2023-11-25', 'complete', 918),
(8, 4, 1877010742, '2023-11-25', 'complete', 470),
(9, 4, 1236694728, '2023-11-25', 'complete', 299),
(10, 10, 935995868, '2023-11-25', 'complete', 499);

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `InsertOrderReminder` AFTER INSERT ON `orders` FOR EACH ROW BEGIN
  -- Insert predefined reminders from the `predefined_reminders` table
  INSERT INTO reminders (customer_id, reminder_date, reminder_message)
  SELECT NEW.cust_id, DATE_ADD(NEW.date, INTERVAL pr.day_interval DAY), pr.reminder_message
  FROM predefined_reminders pr;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_plants`
--

CREATE TABLE `order_plants` (
  `order_plant_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `plant_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_plants`
--

INSERT INTO `order_plants` (`order_plant_id`, `order_id`, `plant_id`, `quantity`) VALUES
(1, 1, 21, 2),
(2, 1, 4, 1),
(3, 2, 22, 2),
(4, 2, 15, 1),
(5, 3, 14, 1),
(8, 5, 19, 1),
(9, 5, 16, 1),
(13, 8, 19, 1),
(14, 8, 4, 1),
(15, 9, 1, 1),
(16, 10, 11, 1);

--
-- Triggers `order_plants`
--
DELIMITER $$
CREATE TRIGGER `after_order` AFTER INSERT ON `order_plants` FOR EACH ROW BEGIN
    UPDATE plants
    SET stocks = stocks - NEW.quantity
    WHERE plant_id = NEW.plant_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `plant_id` int(50) NOT NULL,
  `plant_name` varchar(50) NOT NULL,
  `plant_desc` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `stocks` int(11) NOT NULL,
  `n_name` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`plant_id`, `plant_name`, `plant_desc`, `category_id`, `image`, `price`, `stocks`, `n_name`, `date`, `status`) VALUES
(1, 'Tulip', 'Pack of 1 Christmas Dream Tulip Flower Plant Bulbs Excellent Quality Attractive Flowers for Your hom', 2, 'tulip.jpg', 299, 6, 'Dream Nursery', '2023-11-25 09:54:10', 'true'),
(2, 'Rose', 'Rare grafted dark red rose perinnial flower pack of 1', 2, 'rose.jpg', 180, 5, 'Aiden Gardens', '2023-11-09 03:47:21', 'true'),
(3, 'White Lotus', 'Rear all season white hybrid lotus plant big water lily original variety for outdoor and indoor', 3, 'white_lotus.jpg', 450, 9, 'Somnia Nursery', '2023-11-09 03:47:21', 'true'),
(4, 'Mango fruit', 'Alphonso Mango Plant King Of Mango Grafted Plant in Polypack', 1, 'Mango.jpg', 320, 12, 'Saim Garden', '2023-11-25 09:33:36', 'true'),
(5, 'Apricot', 'Healthy Vibe With Green High Yielding Hybrid Rare Ketcot\" Tropical Apricot\" Tasty Tropical Fruit Liv', 1, 'apricot.jpg', 480, 3, 'Aiden Gardens', '2023-11-09 03:43:29', 'true'),
(6, 'Black Grapes', ' Grape Plant Moon drops Green Seedless Vine Grape Live Cutting Healthy Plant on Poly Bag Pack of 1', 1, 'blackgrapes.jpg', 206, 25, 'Mama Earth', '2023-11-16 05:11:36', 'true'),
(7, 'Apple', 'Apple Plant (Anna) Grafted Live Plant Original Variety fruitful plant', 1, 'apple.jpg', 364, 11, 'Dream Nursery', '2023-11-06 19:20:36', 'true'),
(8, 'AloeVera', 'Aloe vera Medicinal live Plant with Black Nursery Pot| Medicinal Plants | Plant for home| Ayurvedic ', 5, 'aloevar.jpg', 99, 8, 'Mama Earth', '2023-11-09 03:43:29', 'true'),
(9, 'Broccoli', 'GrowZid Broccoli Brussels sprouts Outdoor Gardening Vegetable Plant  Pack', 4, 'brocolli.jpg', 120, 17, 'Saim Garden', '2023-11-25 09:29:41', 'true'),
(10, 'Champa', 'Plants Michelia Champa, Yellow Champak Mulana Champa Plant Son Champa (Orange, Grafted) - Plant', 2, 'champa.jpg', 88, 30, 'Mama Earth', '2023-10-28 14:31:39', 'true'),
(11, 'Bonsai', 'Cute Bonsai Live Plant For Home Indoor With pot', 3, 'bonsai.jpg', 499, 3, 'Saim Garden', '2023-11-25 10:04:00', 'true'),
(12, 'Hibiscus', 'Live Dwarf Hibiscus Flower Plant, White, 15 cm to 30 cm, 1 Piece', 2, 'hibiscus.jpg', 170, 10, 'Saim Garden', '2023-11-07 12:39:56', 'true'),
(13, 'AshvaGandha', 'Ashwagandha Medicinal Live and Healthy Plant With Pot', 5, 'ashvagandha.jpg', 199, 18, 'Somnia Nursery', '2023-10-28 15:11:08', 'true'),
(14, 'Peace Lily', ' Season Flowers Peace Lily, Spathiphyllum - Plant', 6, 'peace_lily.jpg', 320, 14, 'Somnia Nursery', '2023-11-15 03:31:55', 'true'),
(15, 'Tuber Rose', 'Live GreenTuberose/Rajnigandha Mixed Flower SET Of 4 Bulbs New Quality, White', 3, 'tuberose.jpg', 249, 11, 'Dream Nursery', '2023-11-11 09:14:35', 'true'),
(16, 'Jade Plant', 'Good Luck Live Indoor Jade Plant In Black Plastic Pot For Home,Plants for Balcony', 6, 'jade_plant.jpg', 280, 15, 'Saim Garden', '2023-11-25 09:16:21', 'true'),
(17, 'LuckyBamboo', 'Lucky Bamboo Plant in 4 Inch Wide Glass Pot (Small:2 Layer Bamboo) | Living Room Plants | Indoor Pla', 6, 'luckybamboo.jpg', 249, 18, 'Mama Earth', '2023-11-09 04:29:05', 'true'),
(18, 'Passion Fruit', 'Winter Plants Passion Fruit Plant, Krishna Fal (Grown through seeds) - Plant', 1, 'passionfruit.jpg', 429, 15, 'Dream Nursey', '2023-11-09 03:30:32', 'true'),
(19, 'Strawberry', 'weet Juice Strawberry Plant Including 4 Inch Plastic Pot (1 Healthy Hybrid Fruit Plant)', 1, 'strawberry.jpg', 150, 21, 'Saim Garden', '2023-11-25 09:33:36', 'true'),
(21, 'Zinnia', 'Flower Seeds (1 Packet, Mix 1gm) Fragrant Flowering Plants Seeds for Home Gardening | Natural and Re', 7, 'Zinnia_seeds.jpg', 70, 23, 'Aiden Gardens', '2023-11-09 05:52:12', 'true'),
(22, 'Sunflower', ' Sunflower Russian Giant Flower Seeds For Home Gardening (20 seeds Pack)', 7, 'sunflower seeds.jpg', 96, 24, 'Dream Nursey', '2023-11-11 09:14:35', 'true'),
(24, 'Watermelon', 'Healthy watermelon seeds pack of 2', 7, 'watermelon_seeds.jpg', 70, 30, 'Somnia Nursey', '2023-10-28 17:29:17', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `predefined_reminders`
--

CREATE TABLE `predefined_reminders` (
  `reminder_id` int(11) NOT NULL,
  `day_interval` int(11) DEFAULT NULL,
  `reminder_message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `predefined_reminders`
--

INSERT INTO `predefined_reminders` (`reminder_id`, `day_interval`, `reminder_message`) VALUES
(1, 0, 'Watering Reminder: \"Hello!!, Its time to water your new plants again! Remember to water them thoroughly, allowing the soil to dry slightly between waterings to prevent overwatering. Happy gardening!\"'),
(2, 5, 'Sunlight Reminder: \"Hey there, Your plants need some sunshine to thrive. Make sure they are getting the right amount of light according to their specific requirements.Do not hesitate to reach out for advice on how to address them.\"'),
(3, 5, 'Fertilizing Tip: \"Hello again! After 5 days, its a good time to consider fertilizing your plants. Use a balanced, slow-release fertilizer or follow the care instructions we provided for each plant.\"'),
(4, 10, 'Pruning and Deadheading Advice: \"Hi its time for a little maintenance. Check if any dead leaves or flowers need to be removed, and consider a light pruning to encourage healthy growth. Your plants will thank you.\"'),
(5, 15, 'Pest and Disease Watch: \"Hello Plant Parent! Keep an eye out for any signs of pests or diseases. Early detection is key. If you notice any issues.\"'),
(6, 30, 'Repotting Reminder: \"Hey as your plants grow, they might need a bigger home. Its a good time to check if repotting is necessary. We are here to assist if you have any questions.\"');

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `reminder_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `reminder_date` date DEFAULT NULL,
  `reminder_message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`reminder_id`, `customer_id`, `reminder_date`, `reminder_message`) VALUES
(1, 5, '2023-11-09', 'Watering Reminder: \"Hello!!, Its time to water your new plants again! Remember to water them thoroughly, allowing the soil to dry slightly between waterings to prevent overwatering. Happy gardening!\"'),
(2, 5, '2023-11-14', 'Sunlight Reminder: \"Hey there, Your plants need some sunshine to thrive. Make sure they are getting the right amount of light according to their specific requirements.Do not hesitate to reach out for advice on how to address them.\"'),
(3, 5, '2023-11-14', 'Fertilizing Tip: \"Hello again! After 5 days, its a good time to consider fertilizing your plants. Use a balanced, slow-release fertilizer or follow the care instructions we provided for each plant.\"'),
(4, 5, '2023-11-19', 'Pruning and Deadheading Advice: \"Hi its time for a little maintenance. Check if any dead leaves or flowers need to be removed, and consider a light pruning to encourage healthy growth. Your plants will thank you.\"'),
(5, 5, '2023-11-24', 'Pest and Disease Watch: \"Hello Plant Parent! Keep an eye out for any signs of pests or diseases. Early detection is key. If you notice any issues.\"'),
(6, 5, '2023-12-09', 'Repotting Reminder: \"Hey as your plants grow, they might need a bigger home. Its a good time to check if repotting is necessary. We arre here to assist if you have any questions.\"'),
(8, 5, '2023-11-11', 'Watering Reminder: \"Hello!!, Its time to water your new plants again! Remember to water them thoroughly, allowing the soil to dry slightly between waterings to prevent overwatering. Happy gardening!\"'),
(9, 5, '2023-11-16', 'Sunlight Reminder: \"Hey there, Your plants need some sunshine to thrive. Make sure they are getting the right amount of light according to their specific requirements.Do not hesitate to reach out for advice on how to address them.\"'),
(10, 5, '2023-11-16', 'Fertilizing Tip: \"Hello again! After 5 days, its a good time to consider fertilizing your plants. Use a balanced, slow-release fertilizer or follow the care instructions we provided for each plant.\"'),
(11, 5, '2023-11-21', 'Pruning and Deadheading Advice: \"Hi its time for a little maintenance. Check if any dead leaves or flowers need to be removed, and consider a light pruning to encourage healthy growth. Your plants will thank you.\"'),
(12, 5, '2023-11-26', 'Pest and Disease Watch: \"Hello Plant Parent! Keep an eye out for any signs of pests or diseases. Early detection is key. If you notice any issues.\"'),
(13, 5, '2023-12-11', 'Repotting Reminder: \"Hey as your plants grow, they might need a bigger home. Its a good time to check if repotting is necessary. We are here to assist if you have any questions.\"'),
(15, 4, '2023-11-15', 'Watering Reminder: \"Hello!!, Its time to water your new plants again! Remember to water them thoroughly, allowing the soil to dry slightly between waterings to prevent overwatering. Happy gardening!\"'),
(16, 4, '2023-11-20', 'Sunlight Reminder: \"Hey there, Your plants need some sunshine to thrive. Make sure they are getting the right amount of light according to their specific requirements.Do not hesitate to reach out for advice on how to address them.\"'),
(17, 4, '2023-11-20', 'Fertilizing Tip: \"Hello again! After 5 days, its a good time to consider fertilizing your plants. Use a balanced, slow-release fertilizer or follow the care instructions we provided for each plant.\"'),
(18, 4, '2023-11-25', 'Pruning and Deadheading Advice: \"Hi its time for a little maintenance. Check if any dead leaves or flowers need to be removed, and consider a light pruning to encourage healthy growth. Your plants will thank you.\"'),
(19, 4, '2023-11-30', 'Pest and Disease Watch: \"Hello Plant Parent! Keep an eye out for any signs of pests or diseases. Early detection is key. If you notice any issues.\"'),
(20, 4, '2023-12-15', 'Repotting Reminder: \"Hey as your plants grow, they might need a bigger home. Its a good time to check if repotting is necessary. We are here to assist if you have any questions.\"'),
(29, 9, '2023-11-25', 'Watering Reminder: \"Hello!!, Its time to water your new plants again! Remember to water them thoroughly, allowing the soil to dry slightly between waterings to prevent overwatering. Happy gardening!\"'),
(30, 9, '2023-11-30', 'Sunlight Reminder: \"Hey there, Your plants need some sunshine to thrive. Make sure they are getting the right amount of light according to their specific requirements.Do not hesitate to reach out for advice on how to address them.\"'),
(31, 9, '2023-11-30', 'Fertilizing Tip: \"Hello again! After 5 days, its a good time to consider fertilizing your plants. Use a balanced, slow-release fertilizer or follow the care instructions we provided for each plant.\"'),
(32, 9, '2023-12-05', 'Pruning and Deadheading Advice: \"Hi its time for a little maintenance. Check if any dead leaves or flowers need to be removed, and consider a light pruning to encourage healthy growth. Your plants will thank you.\"'),
(33, 9, '2023-12-10', 'Pest and Disease Watch: \"Hello Plant Parent! Keep an eye out for any signs of pests or diseases. Early detection is key. If you notice any issues.\"'),
(34, 9, '2023-12-25', 'Repotting Reminder: \"Hey as your plants grow, they might need a bigger home. Its a good time to check if repotting is necessary. We are here to assist if you have any questions.\"'),
(36, 5, '2023-11-25', 'Watering Reminder: \"Hello!!, Its time to water your new plants again! Remember to water them thoroughly, allowing the soil to dry slightly between waterings to prevent overwatering. Happy gardening!\"'),
(37, 5, '2023-11-30', 'Sunlight Reminder: \"Hey there, Your plants need some sunshine to thrive. Make sure they are getting the right amount of light according to their specific requirements.Do not hesitate to reach out for advice on how to address them.\"'),
(38, 5, '2023-11-30', 'Fertilizing Tip: \"Hello again! After 5 days, its a good time to consider fertilizing your plants. Use a balanced, slow-release fertilizer or follow the care instructions we provided for each plant.\"'),
(39, 5, '2023-12-05', 'Pruning and Deadheading Advice: \"Hi its time for a little maintenance. Check if any dead leaves or flowers need to be removed, and consider a light pruning to encourage healthy growth. Your plants will thank you.\"'),
(40, 5, '2023-12-10', 'Pest and Disease Watch: \"Hello Plant Parent! Keep an eye out for any signs of pests or diseases. Early detection is key. If you notice any issues.\"'),
(41, 5, '2023-12-25', 'Repotting Reminder: \"Hey as your plants grow, they might need a bigger home. Its a good time to check if repotting is necessary. We are here to assist if you have any questions.\"'),
(43, 5, '2023-11-25', 'Watering Reminder: \"Hello!!, Its time to water your new plants again! Remember to water them thoroughly, allowing the soil to dry slightly between waterings to prevent overwatering. Happy gardening!\"'),
(44, 5, '2023-11-30', 'Sunlight Reminder: \"Hey there, Your plants need some sunshine to thrive. Make sure they are getting the right amount of light according to their specific requirements.Do not hesitate to reach out for advice on how to address them.\"'),
(45, 5, '2023-11-30', 'Fertilizing Tip: \"Hello again! After 5 days, its a good time to consider fertilizing your plants. Use a balanced, slow-release fertilizer or follow the care instructions we provided for each plant.\"'),
(46, 5, '2023-12-05', 'Pruning and Deadheading Advice: \"Hi its time for a little maintenance. Check if any dead leaves or flowers need to be removed, and consider a light pruning to encourage healthy growth. Your plants will thank you.\"'),
(47, 5, '2023-12-10', 'Pest and Disease Watch: \"Hello Plant Parent! Keep an eye out for any signs of pests or diseases. Early detection is key. If you notice any issues.\"'),
(48, 5, '2023-12-25', 'Repotting Reminder: \"Hey as your plants grow, they might need a bigger home. Its a good time to check if repotting is necessary. We are here to assist if you have any questions.\"'),
(50, 4, '2023-11-25', 'Watering Reminder: \"Hello!!, Its time to water your new plants again! Remember to water them thoroughly, allowing the soil to dry slightly between waterings to prevent overwatering. Happy gardening!\"'),
(51, 4, '2023-11-30', 'Sunlight Reminder: \"Hey there, Your plants need some sunshine to thrive. Make sure they are getting the right amount of light according to their specific requirements.Do not hesitate to reach out for advice on how to address them.\"'),
(52, 4, '2023-11-30', 'Fertilizing Tip: \"Hello again! After 5 days, its a good time to consider fertilizing your plants. Use a balanced, slow-release fertilizer or follow the care instructions we provided for each plant.\"'),
(53, 4, '2023-12-05', 'Pruning and Deadheading Advice: \"Hi its time for a little maintenance. Check if any dead leaves or flowers need to be removed, and consider a light pruning to encourage healthy growth. Your plants will thank you.\"'),
(54, 4, '2023-12-10', 'Pest and Disease Watch: \"Hello Plant Parent! Keep an eye out for any signs of pests or diseases. Early detection is key. If you notice any issues.\"'),
(55, 4, '2023-12-25', 'Repotting Reminder: \"Hey as your plants grow, they might need a bigger home. Its a good time to check if repotting is necessary. We are here to assist if you have any questions.\"'),
(57, 4, '2023-11-25', 'Watering Reminder: \"Hello!!, Its time to water your new plants again! Remember to water them thoroughly, allowing the soil to dry slightly between waterings to prevent overwatering. Happy gardening!\"'),
(58, 4, '2023-11-30', 'Sunlight Reminder: \"Hey there, Your plants need some sunshine to thrive. Make sure they are getting the right amount of light according to their specific requirements.Do not hesitate to reach out for advice on how to address them.\"'),
(59, 4, '2023-11-30', 'Fertilizing Tip: \"Hello again! After 5 days, its a good time to consider fertilizing your plants. Use a balanced, slow-release fertilizer or follow the care instructions we provided for each plant.\"'),
(60, 4, '2023-12-05', 'Pruning and Deadheading Advice: \"Hi its time for a little maintenance. Check if any dead leaves or flowers need to be removed, and consider a light pruning to encourage healthy growth. Your plants will thank you.\"'),
(61, 4, '2023-12-10', 'Pest and Disease Watch: \"Hello Plant Parent! Keep an eye out for any signs of pests or diseases. Early detection is key. If you notice any issues.\"'),
(62, 4, '2023-12-25', 'Repotting Reminder: \"Hey as your plants grow, they might need a bigger home. Its a good time to check if repotting is necessary. We are here to assist if you have any questions.\"'),
(64, 10, '2023-11-25', 'Watering Reminder: \"Hello!!, Its time to water your new plants again! Remember to water them thoroughly, allowing the soil to dry slightly between waterings to prevent overwatering. Happy gardening!\"'),
(65, 10, '2023-11-30', 'Sunlight Reminder: \"Hey there, Your plants need some sunshine to thrive. Make sure they are getting the right amount of light according to their specific requirements.Do not hesitate to reach out for advice on how to address them.\"'),
(66, 10, '2023-11-30', 'Fertilizing Tip: \"Hello again! After 5 days, its a good time to consider fertilizing your plants. Use a balanced, slow-release fertilizer or follow the care instructions we provided for each plant.\"'),
(67, 10, '2023-12-05', 'Pruning and Deadheading Advice: \"Hi its time for a little maintenance. Check if any dead leaves or flowers need to be removed, and consider a light pruning to encourage healthy growth. Your plants will thank you.\"'),
(68, 10, '2023-12-10', 'Pest and Disease Watch: \"Hello Plant Parent! Keep an eye out for any signs of pests or diseases. Early detection is key. If you notice any issues.\"'),
(69, 10, '2023-12-25', 'Repotting Reminder: \"Hey as your plants grow, they might need a bigger home. Its a good time to check if repotting is necessary. We are here to assist if you have any questions.\"');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `cust_id` int(50) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`cust_id`, `fname`, `lname`, `email`, `password`, `user_ip`, `address`, `contact`) VALUES
(4, 'Chetana', 'P', 'chetana@gmail.com', '$2y$10$93VV6W7XdHz3izoUz1CWe.LMCqDEUeyvCjOqRdknhCb7jOtpqNmWC', '', 'MPL', '6304264818'),
(5, 'Nisarga', 'Kunder', 'nisarga@gmail.com', '$2y$10$jN0q6vDt60D8t4nwbwjMh.pRKuoC3flAWMYhw1H6F9RvU0k62SYOy', '', 'udupi', '9876543211'),
(7, 'Bhavana', 'Hugar', 'hugar@gmail.com', '$2y$10$4/Z5TTflJPkIv/2Fb2sy0.OU6BsZy3XS8Chm9e302dXL/rNu9KU1G', '', 'Bangalore', '7894563210'),
(8, 'Pramathi', 'V', 'pramathi@gmail.com', '$2y$10$jKRetDMjwbpXoRfyqtTYaO45bhDhrXFSLxi1T71mkuriWM85A2fjy', '::1', 'Bangalore', '9874563210'),
(9, 'Niha', 'finn', 'niha@gmail.com', '$2y$10$J/4Czraz5ZGJeG7h/J3K6.P3jYYbe1lEmwFK.YT2pnLg1R01ShbQa', '::1', 'london', '9876543789'),
(10, 'rohan', 'raj', 'rohan@gmail.com', '$2y$10$jep8lg2jIff2pdpOZXsGP.8iSIbO5qOHTpwYJS3IbSJ6adDYnocQy', '::1', 'Mangalore', '8765434567');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `ckf` (`plant_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `nursery`
--
ALTER TABLE `nursery`
  ADD PRIMARY KEY (`nursery_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `order_plants`
--
ALTER TABLE `order_plants`
  ADD PRIMARY KEY (`order_plant_id`),
  ADD KEY `plant_id` (`plant_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`plant_id`),
  ADD KEY `cat1` (`category_id`);

--
-- Indexes for table `predefined_reminders`
--
ALTER TABLE `predefined_reminders`
  ADD PRIMARY KEY (`reminder_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`reminder_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`cust_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nursery`
--
ALTER TABLE `nursery`
  MODIFY `nursery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_plants`
--
ALTER TABLE `order_plants`
  MODIFY `order_plant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `plant_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `predefined_reminders`
--
ALTER TABLE `predefined_reminders`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `cust_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`plant_id`) REFERENCES `plants` (`plant_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_plants`
--
ALTER TABLE `order_plants`
  ADD CONSTRAINT `order_plants_ibfk_1` FOREIGN KEY (`plant_id`) REFERENCES `plants` (`plant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_plants_ibfk_2` FOREIGN KEY (`plant_id`) REFERENCES `plants` (`plant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_plants_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- For every table foriegn key constraint is added with on update and on delete cascade
-- Nested queries are implemented directly in php code
-- corelated queries are implemented directly in php code
-- aggregate function with having clause are implemented directly in php code
-- other select ,join queries are implemented directly in php code
-- Functions,Procedure,Trigger are there in this sql file (implemented in the frontend as well)