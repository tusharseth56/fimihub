--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `verification_code`, `email`, `email_verified_at`, `country_code`, `mobile`, `mobile_verified_at`, `password`, `picture`, `user_type`, `device_token`, `visibility`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'hdgfcfgfdddddddddddddddd', NULL, 'acfgcsgf@agss.ccc', NULL, '+91', '8840212084', '2020-11-20 11:08:26', '$2y$10$CchqzTkM69C8P/V.UmVvG.ka688HYocr9w58MpYEK35ia7ImfeYeq', NULL, 3, 'dfdsfdfd', 0, NULL, '2020-11-15 04:29:20', '2020-11-20 11:08:26'),
(2, 'dsdsds', NULL, 'admin@fimihub.com', NULL, NULL, '8888888888', NULL, '$2y$10$15QH4drj.ed7eaakKyVGq.lxfYQ6JWA7pPbvMS25CYPQZ8AkTdo6O', NULL, 1, NULL, 0, NULL, NULL, NULL),
(3, 'Dominos', NULL, 'abc@fimihub.com', NULL, NULL, '8840212041', '2020-11-15 04:50:13', '$2y$10$WHuMAP6NNcZtNJjjoMN3O.0YgGnSa4Aoyhkcd.ogFCOWKnl98xNpe', NULL, 4, NULL, 0, NULL, '2020-11-15 04:34:33', '2020-11-15 04:50:13'),
(8, 'hdgfcfgf', '5674', NULL, NULL, '+91', '8840212081', NULL, '$2y$10$29cdj1BBtC83DBsfetonMu5wheP.hJF.XCwXcDRzMgE0kXQGInyp6', NULL, 2, NULL, 0, NULL, '2020-11-17 10:29:38', '2020-11-17 10:29:38'),
(9, 'hdgfcfgf', '2874', NULL, NULL, '+91', '8840212082', NULL, '$2y$10$lqB6QopY.g.X9mt9Mo8D9ucZchOys76Pa/kSiNN/RzvQGxcAKSptq', NULL, 2, NULL, 0, NULL, '2020-11-18 03:26:57', '2020-11-18 03:26:57');

-- --------------------------------------------------------

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `address`, `flat_no`, `landmark`, `latitude`, `longitude`, `default_status`, `visibility`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'delhi', '11/24', 'bank', NULL, NULL, 2, 0, NULL, '2020-11-16 04:52:38', '2020-11-16 04:52:38'),
(2, 1, 'delhi', '222ssa assa', 'bank', NULL, NULL, 1, 0, NULL, '2020-11-16 08:05:42', '2020-11-16 08:27:21'),
(3, 1, 'Block 11, Moti Nagar, New Delhi, Delhi, India', '11/24', 'school', '28.6600792', '77.1386294', 2, 0, NULL, '2020-11-21 14:59:51', '2020-11-21 14:59:51'),
(4, 1, 'sdds', '11/24', 'bank', '0', '0', 2, 0, NULL, '2020-11-21 15:02:00', '2020-11-21 15:02:00');

-- --------------------------------------------------------

--
-- Dumping data for table `vehicle_details`
--

INSERT INTO `vehicle_details` (`id`, `user_id`, `vehicle_number`, `model_name`, `vehicle_image`, `color`, `id_proof`, `address`, `pincode`, `driving_license`, `dl_start_date`, `dl_end_date`, `registraion_start_date`, `registraion_end_date`, `visibility`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 8, 'b s22s5', 'assc', 'http://127.0.0.1:8000/uploads/8/images/VehiclePicture1605628779.png', 'sac', 'http://127.0.0.1:8000/uploads/8/documents/IDProof1605628779.pdf', 'sasadadd', 122121, 'http://127.0.0.1:8000/uploads/8/images/DL1605628779.png', 'saas', 'sasa', 'sasa', 'sasa', 0, NULL, '2020-11-17 10:29:39', '2020-11-17 10:29:39'),
(2, 9, 'b s22s5', 'assc', NULL, 'sac', 'http://127.0.0.1:8000/uploads/9/documents/IDProof1605689817.pdf', 'sasadadd', 122121, 'http://127.0.0.1:8000/uploads/9/images/DL1605689817.png', 'saas', 'sasa', 'sasa', 'sasa', 0, NULL, '2020-11-18 03:26:57', '2020-11-18 03:26:57'),
(3, 1, 'b s22s5555', 'assc', 'http://127.0.0.1:8000/uploads/1/images/VehiclePicture1605773593.png', 'sac', 'http://127.0.0.1:8000/uploads/1/documents/IDProof1605773593.pdf', 'sasadadd', 122121, 'http://127.0.0.1:8000/uploads/1/images/DL1605773593.png', 'saas', 'sasa', 'sasa', 'sasa', 0, NULL, '2020-11-18 09:18:36', '2020-11-19 02:43:13');

-- --------------------------------------------------------

--
-- Dumping data for table `rider_bank_details`
--

INSERT INTO `rider_bank_details` (`id`, `user_id`, `account_number`, `holder_name`, `branch_name`, `ifsc_code`, `visibility`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 8, 'asasas21', 'sadc d', 'saxa', 'sax', 0, NULL, '2020-11-17 10:29:39', '2020-11-17 10:29:39'),
(2, 9, 'asasas21', 'sadc d', 'saxa', 'sax', 0, NULL, '2020-11-18 03:26:57', '2020-11-18 03:26:57'),
(3, 1, 'asasas212222', 'sadc d', 'saxa', 'sax', 0, NULL, '2020-11-18 09:50:15', '2020-11-19 02:43:13');

-- --------------------------------------------------------

--
-- Dumping data for table `restaurent_details`
--

INSERT INTO `restaurent_details` (`id`, `user_id`, `resto_id`, `name`, `about`, `other_details`, `official_number`, `picture`, `avg_cost`, `avg_time`, `open_time`, `close_time`, `address`, `delivery_charge`, `discount`, `tax`, `pincode`, `payment_method_type`, `resto_type`, `visibility`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 'FIMIRESTO100001', 'Dominos', 'cdfvdf', 'dvsdcvsdvsdvsdvdsvsdv', NULL, 'http://127.0.0.1:8000/uploads/3/images/RestaurentProfilePicture1605435749.png', '850.00', '35', NULL, NULL, 'newyork', '2.00', '2.00', NULL, NULL, NULL, 2, 0, NULL, '2020-11-15 04:52:29', '2020-11-15 04:52:29');


-- --------------------------------------------------------

--
-- Dumping data for table `service_catagories`
--

INSERT INTO `service_catagories`(`id`, `name`, `listing_order`, `visibility`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'food',  1, 0, NULL, '2020-11-15 04:45:48', '2020-11-15 04:45:48'),
(2, 'grocery',  2, 0, NULL, '2020-11-15 04:46:52', '2020-11-15 04:46:52'),
(3, 'electronics', 3, 0, NULL, '2020-11-15 04:47:30', '2020-11-15 04:47:30');

-- --------------------------------------------------------



-- --------------------------------------------------------

--
-- Dumping data for table `menu_categories`
--

INSERT INTO `menu_categories` (`id`,`service_catagory_id`, `name`, `about`, `discount`, `listing_order`, `visibility`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'drinks', NULL, NULL, 1, 0, NULL, '2020-11-15 04:45:48', '2020-11-15 04:45:48'),
(2, 1, 'burger', NULL, NULL, 2, 0, NULL, '2020-11-15 04:46:52', '2020-11-15 04:46:52'),
(3, 1, 'Main Course', NULL, NULL, 3, 0, NULL, '2020-11-15 04:47:30', '2020-11-15 04:47:30');

-- --------------------------------------------------------

--
-- Dumping data for table `menu_list`
--

INSERT INTO `menu_list` (`id`, `restaurent_id`, `menu_category_id`, `name`, `picture`, `about`, `price`, `discount`, `dish_type`, `listing_order`, `visibility`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'burger', 'http://127.0.0.1:8000/uploads/3/images/burger1605435849.png', 'sdbfbj', '299.00', NULL, 2, 1, 0, NULL, '2020-11-15 04:54:09', '2020-11-15 04:54:09'),
(2, 1, 1, 'cola', NULL, NULL, '25.00', NULL, NULL, NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `restaurent_id`, `address_id`, `customer_name`, `applied_coupon`, `delivery_fee`, `tax`, `visibility`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'jhsdg', NULL, '3.00', NULL, 2, NULL, '2020-11-15 04:56:06', '2020-11-15 04:56:06'),
(3, 1, 1, NULL, 'hdgfcfgfdddddddddddddddd', NULL, '2.00', NULL, 2, NULL, '2020-11-23 12:11:46', '2020-11-23 12:11:46'),
(4, 1, 1, NULL, 'hdgfcfgfdddddddddddddddd', NULL, '2.00', NULL, 2, NULL, '2020-11-23 12:18:40', '2020-11-23 12:18:40'),
(5, 1, 1, 2, 'hdgfcfgfdddddddddddddddd', NULL, '2.00', NULL, 2, NULL, '2020-11-23 12:27:30', '2020-11-23 12:27:30');

-- --------------------------------------------------------
--
-- Dumping data for table `cart_submenus`
--

INSERT INTO `cart_submenus` (`id`, `user_id`, `cart_id`, `menu_id`, `quantity`, `visibility`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 1, 4, 2, '1', 2, NULL, '2020-11-15 12:19:28', '2020-11-23 12:19:10'),
(4, 1, 4, 2, '1', 2, NULL, '2020-11-15 14:01:44', '2020-11-23 12:19:10'),
(5, 1, 4, 2, '1', 2, NULL, '2020-11-15 14:05:40', '2020-11-23 12:19:10'),
(6, 1, 4, 2, '1', 2, NULL, '2020-11-15 14:13:03', '2020-11-23 12:19:10'),
(7, 1, 4, 2, '1', 0, NULL, '2020-11-15 14:39:01', '2020-11-23 12:19:10'),
(12, 1, 4, 2, '1', 0, NULL, '2020-11-23 12:18:40', '2020-11-23 12:19:10'),
(13, 1, 4, 1, '1', 0, NULL, '2020-11-23 12:19:19', '2020-11-23 12:19:19'),
(14, 1, 5, 2, '1', 2, NULL, '2020-11-23 12:27:30', '2020-11-23 12:33:16'),
(15, 1, 5, 1, '2', 0, NULL, '2020-11-23 12:29:57', '2020-11-23 12:33:37'),
(16, 1, 5, 2, '1', 0, NULL, '2020-11-23 12:31:44', '2020-11-23 12:33:16');

-- --------------------------------------------------------
--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `restaurent_id`, `cart_id`, `address_id`, `order_id`, `customer_name`, `ordered_menu`, `mobile`, `total_amount`, `delivery_fee`, `tax`, `order_status`, `payment_status`, `payment_type`, `visibility`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 1, 2, 'FF10000000001', 'jhsdg', '[{\"id\":2,\"restaurent_id\":1,\"menu_category_id\":1,\"name\":\"cola\",\"picture\":null,\"about\":null,\"price\":\"25.00\",\"discount\":null,\"dish_type\":null,\"listing_order\":null,\"visibility\":0,\"deleted_at\":null,\"created_at\":null,\"updated_at\":null,\"quantity\":\"4\"}]', '8840212040', '100.00', '2.00', NULL, 1, 1, 1, 0, NULL, NULL, NULL),
(5, 1, 1, 1, 2, 'FF10000000005', 'hdgfcfgfdddddddddddddddd', '[{\"id\":2,\"restaurent_id\":1,\"menu_category_id\":1,\"name\":\"cola\",\"picture\":null,\"about\":null,\"price\":\"25.00\",\"discount\":null,\"dish_type\":null,\"listing_order\":null,\"visibility\":0,\"deleted_at\":null,\"created_at\":null,\"updated_at\":null,\"quantity\":\"5\"}]', '8840212084', '125.00', '2.00', NULL, 1, 1, 3, 0, NULL, NULL, NULL),
(6, 1, 1, 1, 2, 'FF10000000006', 'hdgfcfgfdddddddddddddddd', '[{\"id\":2,\"restaurent_id\":1,\"menu_category_id\":1,\"name\":\"cola\",\"picture\":null,\"about\":null,\"price\":\"25.00\",\"discount\":null,\"dish_type\":null,\"listing_order\":null,\"visibility\":0,\"deleted_at\":null,\"created_at\":null,\"updated_at\":null,\"quantity\":\"5\"}]', '8840212084', '125.00', '2.00', NULL, 1, 1, 3, 0, NULL, NULL, NULL),
(7, 1, 1, 1, 2, 'FF10000000007', 'hdgfcfgfdddddddddddddddd', '[{\"id\":2,\"restaurent_id\":1,\"menu_category_id\":1,\"name\":\"cola\",\"picture\":null,\"about\":null,\"price\":\"25.00\",\"discount\":null,\"dish_type\":null,\"listing_order\":null,\"visibility\":0,\"deleted_at\":null,\"created_at\":null,\"updated_at\":null,\"quantity\":\"5\"}]', '8840212084', '125.00', '2.00', NULL, 1, 1, 3, 0, NULL, NULL, NULL),
(8, 1, 1, 1, 2, 'FF10000000008', 'hdgfcfgfdddddddddddddddd', '[{\"id\":2,\"restaurent_id\":1,\"menu_category_id\":1,\"name\":\"cola\",\"picture\":null,\"about\":null,\"price\":\"25.00\",\"discount\":null,\"dish_type\":null,\"listing_order\":null,\"visibility\":0,\"deleted_at\":null,\"created_at\":null,\"updated_at\":null,\"quantity\":\"5\"}]', '8840212084', '125.00', '2.00', NULL, 1, 1, 3, 0, NULL, NULL, NULL),
(9, 1, 1, 1, 2, 'FF10000000009', 'hdgfcfgfdddddddddddddddd', '[{\"id\":2,\"restaurent_id\":1,\"menu_category_id\":1,\"name\":\"cola\",\"picture\":null,\"about\":null,\"price\":\"25.00\",\"discount\":null,\"dish_type\":null,\"listing_order\":null,\"visibility\":0,\"deleted_at\":null,\"created_at\":null,\"updated_at\":null,\"quantity\":\"5\"}]', '8840212084', '125.00', '2.00', NULL, 1, 1, 3, 0, NULL, NULL, NULL),
(10, 1, 1, 1, 2, 'FF10000000010', 'hdgfcfgfdddddddddddddddd', '[{\"id\":2,\"restaurent_id\":1,\"menu_category_id\":1,\"name\":\"cola\",\"picture\":null,\"about\":null,\"price\":\"25.00\",\"discount\":null,\"dish_type\":null,\"listing_order\":null,\"visibility\":0,\"deleted_at\":null,\"created_at\":null,\"updated_at\":null,\"quantity\":\"5\"}]', '8840212084', '125.00', '2.00', NULL, 1, 1, 3, 0, NULL, '2020-11-20 12:17:48', '2020-11-20 12:17:48'),
(11, 1, 1, 1, 2, 'FF10000000011', 'hdgfcfgfdddddddddddddddd', '[{\"id\":2,\"restaurent_id\":1,\"menu_category_id\":1,\"name\":\"cola\",\"picture\":null,\"about\":null,\"price\":\"25.00\",\"discount\":null,\"dish_type\":null,\"listing_order\":null,\"visibility\":0,\"deleted_at\":null,\"created_at\":null,\"updated_at\":null,\"quantity\":\"5\"}]', '8840212084', '125.00', '2.00', NULL, 1, 1, 3, 0, NULL, '2020-11-20 12:18:03', '2020-11-20 12:18:03'),
(12, 1, 1, 1, 2, 'FF10000000012', 'hdgfcfgfdddddddddddddddd', '[{\"id\":2,\"restaurent_id\":1,\"menu_category_id\":1,\"name\":\"cola\",\"picture\":null,\"about\":null,\"price\":\"25.00\",\"discount\":null,\"dish_type\":null,\"listing_order\":null,\"visibility\":0,\"deleted_at\":null,\"created_at\":null,\"updated_at\":null,\"quantity\":\"5\"}]', '8840212084', '125.00', '2.00', NULL, 1, 1, 3, 0, NULL, '2020-11-20 12:19:04', '2020-11-20 12:19:04'),
(13, 1, 1, 1, 2, 'FF10000000013', 'hdgfcfgfdddddddddddddddd', '[{\"id\":2,\"restaurent_id\":1,\"menu_category_id\":1,\"name\":\"cola\",\"picture\":null,\"about\":null,\"price\":\"25.00\",\"discount\":null,\"dish_type\":null,\"listing_order\":null,\"visibility\":0,\"deleted_at\":null,\"created_at\":null,\"updated_at\":null,\"quantity\":\"5\"}]', '8840212084', '125.00', '2.00', NULL, 1, 1, 3, 0, NULL, '2020-11-20 12:30:05', '2020-11-20 12:30:05'),
(14, 1, 1, 1, 2, 'FF10000000014', 'hdgfcfgfdddddddddddddddd', '[{\"id\":2,\"restaurent_id\":1,\"menu_category_id\":1,\"name\":\"cola\",\"picture\":null,\"about\":null,\"price\":\"25.00\",\"discount\":null,\"dish_type\":null,\"listing_order\":null,\"visibility\":0,\"deleted_at\":null,\"created_at\":null,\"updated_at\":null,\"quantity\":\"5\"}]', '8840212084', '125.00', '2.00', NULL, 1, 1, 3, 0, NULL, '2020-11-20 12:32:17', '2020-11-20 12:32:17'),
(15, 1, 1, 1, 2, 'FF10000000015', 'hdgfcfgfdddddddddddddddd', '[{\"id\":2,\"restaurent_id\":1,\"menu_category_id\":1,\"name\":\"cola\",\"picture\":null,\"about\":null,\"price\":\"25.00\",\"discount\":null,\"dish_type\":null,\"listing_order\":null,\"visibility\":0,\"deleted_at\":null,\"created_at\":null,\"updated_at\":null,\"quantity\":\"5\"}]', '8840212084', '125.00', '2.00', NULL, 1, 1, 3, 0, NULL, '2020-11-20 12:35:59', '2020-11-20 12:35:59'),
(16, 1, 1, 1, 2, 'FF10000000016', 'hdgfcfgfdddddddddddddddd', '[{\"id\":2,\"restaurent_id\":1,\"menu_category_id\":1,\"name\":\"cola\",\"picture\":null,\"about\":null,\"price\":\"25.00\",\"discount\":null,\"dish_type\":null,\"listing_order\":null,\"visibility\":0,\"deleted_at\":null,\"created_at\":null,\"updated_at\":null,\"quantity\":\"5\"},{\"id\":1,\"restaurent_id\":1,\"menu_category_id\":2,\"name\":\"burger\",\"picture\":\"http:\\/\\/127.0.0.1:8000\\/uploads\\/3\\/images\\/burger1605435849.png\",\"about\":\"sdbfbj\",\"price\":\"299.00\",\"discount\":null,\"dish_type\":2,\"listing_order\":1,\"visibility\":0,\"deleted_at\":null,\"created_at\":\"2020-11-15 10:24:09\",\"updated_at\":\"2020-11-15 10:24:09\",\"quantity\":\"1\"}]', '8840212084', '424.00', '2.00', NULL, 10, 1, 2, 0, NULL, '2020-11-20 13:14:51', '2020-11-20 13:14:51'),
(17, 1, 1, 1, 2, 'FF10000000017', 'hdgfcfgfdddddddddddddddd', '[{\"id\":2,\"restaurent_id\":1,\"menu_category_id\":1,\"name\":\"cola\",\"picture\":null,\"about\":null,\"price\":\"25.00\",\"discount\":null,\"dish_type\":null,\"listing_order\":null,\"visibility\":0,\"deleted_at\":null,\"created_at\":null,\"updated_at\":null,\"quantity\":\"5\"},{\"id\":1,\"restaurent_id\":1,\"menu_category_id\":2,\"name\":\"burger\",\"picture\":\"http:\\/\\/127.0.0.1:8000\\/uploads\\/3\\/images\\/burger1605435849.png\",\"about\":\"sdbfbj\",\"price\":\"299.00\",\"discount\":null,\"dish_type\":2,\"listing_order\":1,\"visibility\":0,\"deleted_at\":null,\"created_at\":\"2020-11-15 10:24:09\",\"updated_at\":\"2020-11-15 10:24:09\",\"quantity\":\"2\"}]', '8840212084', '723.00', '3.00', NULL, 6, 2, 2, 0, NULL, '2020-11-20 14:03:03', '2020-11-20 14:03:03'),
(18, 1, 1, 5, 2, 'FF10000000018', 'hdgfcfgfdddddddddddddddd', '[{\"id\":1,\"restaurent_id\":1,\"menu_category_id\":2,\"name\":\"burger\",\"picture\":\"http:\\/\\/127.0.0.1:8000\\/uploads\\/3\\/images\\/burger1605435849.png\",\"about\":\"sdbfbj\",\"price\":\"299.00\",\"discount\":null,\"dish_type\":2,\"listing_order\":1,\"visibility\":0,\"deleted_at\":null,\"created_at\":\"2020-11-15 10:24:09\",\"updated_at\":\"2020-11-15 10:24:09\",\"quantity\":\"2\"},{\"id\":2,\"restaurent_id\":1,\"menu_category_id\":1,\"name\":\"cola\",\"picture\":null,\"about\":null,\"price\":\"25.00\",\"discount\":null,\"dish_type\":null,\"listing_order\":null,\"visibility\":0,\"deleted_at\":null,\"created_at\":null,\"updated_at\":null,\"quantity\":\"1\"}]', '8840212084', '623.00', '2.00', NULL, 4, 2, 3, 0, NULL, '2020-11-23 12:34:33', '2020-11-23 12:34:33');

