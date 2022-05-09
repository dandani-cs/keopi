--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`categoryid` int(11) NOT NULL,
  `catname` varchar(30) NOT NULL
);

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `catname`) VALUES
(1, 'Coffee-Based'),
(2, 'Non-Coffee'),
(3, 'Ade'),
(4, 'Iced-Tea'),
(5, 'Lemonade'),
(6,'Sandwiches'),
(7, 'Pastries');


-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `productid` int(11) NOT NULL,
  `categoryid` int(1) NOT NULL,
  `productname` varchar(30) NOT NULL,
  `prodDesc` varchar(60) NOT NULL,
  `price` double NOT NULL,
  `photo` varchar(150) NOT NULL
);

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `categoryid`, `productname`, `prodDesc`, `price`, `photo`) VALUES

(101, 1, 'Americano', 'Espresso + Water', 80, 'images/101.jpg'),
(102, 1, 'Cappuccino', 'Espresso + Foamed Milk', 100, 'images/102.jpg'),
(103, 1, 'Cafe Latte', 'Espresso + Milk', 100, 'images/103.jpg'),
(104, 1, 'Caramel Macchiato', 'Vanilla Syrup + Milk + Espresso + Caramel Sauce', 110, 'images/104.jpg'),
(105, 1, 'Cafe Mocha', 'Espresso + Chocolate Sauce + Milk', 110, 'images/105.jpg'),
(106, 1, 'White Chocolate Mocha', 'Espresso + White Chocolate Sauce + Milk', 110, 'images/106.jpg'),
(107, 1, 'Dalgona', 'Dalgona + Milk', 110, 'images/107.jpg'),

(201, 2, 'Chocolate Milk', '', 110, 'images/201.jpg'),
(202, 2, 'Strawberry Milk', '', 130, 'images/202.jpg'),
(203, 2, 'Strawberry Matcha', '', 145, 'images/203.jpg'),

(301, 3, 'Honey Citron Ade', '', 110, 'images/301.jpg'),
(302, 3, 'Peach Ade', '', 98, 'images/302.jpg'),
(303, 3, 'Lychee Ade', '', 98, 'images/303.jpg'),
(304, 3, 'Passion Fruit Ade', '', 98, 'images/304.jpg'),

(401, 4, 'Hibiscus Iced Tea', '', 89, 'images/401.jpg'),
(402, 4, 'Lemongrass Iced Tea', '', 89, 'images/402.jpg'),

(501, 5, 'Butterfly Pea Lemonade', '', 98, 'images/501.jpg'),
(502, 5, 'Chamomile Lemonade', '', 98, 'images/502.jpg'),

(601, 6, 'Egg & Cheese Sandwich', '', 99, 'images/601.jpg'),
(602, 6, 'Egg, Bacon & Cheese Sandwich', '', 120, 'images/602.jpg'),

(701, 7, 'Cinnamon Rolls', '', 45, 'images/701.jpg'),
(702, 7, 'Banana Bread', '', 35, 'images/702.jpg'),
(703, 7, 'Chocolate Chip Cookies', '', 45, 'images/703.jpg');
-- --------------------------------------------------------

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`productid`);

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
