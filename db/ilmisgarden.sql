-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2026 at 06:19 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ilmisgarden`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `email`, `password`, `created_at`) VALUES
(3, 'admin', 'admin@ilmis.com', '$2y$12$aHEEz0hJ4bRuDjlMwosHHeoN8qfT/dierWoBtyo9eIX3.uFDm2FYy', '2025-09-10 04:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL,
  `campaign_name` varchar(255) NOT NULL,
  `campaign_code` varchar(100) NOT NULL,
  `campaign_token` varchar(255) NOT NULL,
  `discount_type` enum('percent','fixed') DEFAULT 'percent',
  `discount_value` decimal(10,2) NOT NULL DEFAULT '10.00',
  `status` enum('ACTIVE','INACTIVE') DEFAULT 'ACTIVE',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `campaign_name`, `campaign_code`, `campaign_token`, `discount_type`, `discount_value`, `status`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'Display QR Code Utama', 'DISPLAY2026', 'dec6e568e2ffd047e6c32da5617764d6', 'percent', '10.00', 'ACTIVE', NULL, NULL, '2026-07-25 16:01:09', '2026-07-25 16:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `campaign_visits`
--

CREATE TABLE `campaign_visits` (
  `id` int(11) NOT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `campaign_code` varchar(100) DEFAULT NULL,
  `campaign_name` varchar(100) NOT NULL,
  `source` varchar(100) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `campaign_visits`
--

INSERT INTO `campaign_visits` (`id`, `campaign_id`, `campaign_code`, `campaign_name`, `source`, `ip_address`, `created_at`) VALUES
(5, 1, 'DISPLAY2026', 'Display QR Code Utama', 'QR', '::1', '2026-07-25 16:02:25');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `user_id`, `product_id`, `qty`, `created_at`, `updated_at`) VALUES
(1, 'IL002', 162, 1, '2026-07-25 16:02:45', '2026-07-25 16:02:45'),
(2, 'IL002', 161, 1, '2026-07-25 16:03:00', '2026-07-25 16:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `catalog` varchar(50) DEFAULT NULL,
  `flower` varchar(50) DEFAULT NULL,
  `occasion` varchar(50) DEFAULT NULL,
  `is_bestseller` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `catalog`, `flower`, `occasion`, `is_bestseller`) VALUES
(79, 'Sweet Bouquet', 360000, 'Sweet Bouquet adalah rangkaian bunga bernuansa lembut yang memancarkan cinta, kehangatan, dan ketulusan. Perpaduan sweet rose yang mekar sempurna dengan sentuhan baby breath dan daun parvi menciptakan kesan manis sekaligus elegan. Ornamen berbentuk hati menambah nuansa romantis, menjadikannya pilihan sempurna untuk mengungkapkan rasa sayang di momen spesial Sebulan Penuh Cinta ini, atau sekadar mengatakan “I’m thinking of you.”\r\n\r\nDibalut wrapping soft pink khas ilmisgarden, Sweet Bouquet hadir sebagai simbol cinta yang sederhana namun penuh makna.\r\n\r\nAprox 30x20x40 cm', 'Bouquet', 'Rose', 'Anniversary,Birthday,Valentine,Sebulan Penuh Cinta', 0),
(80, 'Baby Breath Bloom', 145000, 'Baby Breath Bloom menghadirkan keindahan yang ringan, manis, dan penuh ketulusan. Rangkaian baby breath berwarna pink dan hijau menciptakan tampilan yang unik, segar, sekaligus romantis. Dilengkapi dengan ornamen berbentuk hati, buket ini melambangkan cinta yang sederhana namun terus tumbuh, seperti perhatian kecil yang berarti besar.\r\n\r\nDibungkus dengan wrapping hijau sage yang modern dan pita pink, buket ini sempurna untuk momen berbagi kasih sayang di Sebulan Penuh Cinta.\r\n\r\nAprox 30x20x40 cm', 'Bouquet', NULL, 'Birthday,Valentine,Sebulan Penuh Cinta', 0),
(81, 'Blushing Heart Bouquet', 590000, 'Blushing Heart Bouquet memancarkan pesona ceria dengan sentuhan lembut dan modern. Rangkaian bunga pompom berwarna pink-ungu tampil manis dan bertekstur unik, dipadukan dengan daun parvi segar yang memberi kesan seimbang dan elegan. Ornamen berbentuk hati berwarna pink menambah nuansa romantis tanpa berlebihan.\r\n\r\nDibalut wrapping hijau sage dan pita pink khas ilmisgarden, buket ini melambangkan kasih sayang, kebahagiaan, dan perhatian yang hangat, sempurna untuk hadiah manis di momen Sebulan Penuh Cinta.\r\n\r\nAprox 30x20x40 cm', 'Bouquet', 'Pom-pom', 'Valentine,Sebulan Penuh Cinta', 0),
(82, 'Soft Crush Bouquet', 550000, 'Soft Crush Bouquet dirangkai dengan penuh cinta untuk menyampaikan rasa cinta atau kasih sayang kepada pasangan. Menggunakan kombinasi bunga lily putih yang lembut, gompie putih yang bertekstur unik, daun parvi, baby breath, serta mawar sweet pink yang membuat buket ini terlihat manis dan menarik. Dilengkapi juga ornamen berbentuk hati sebagai simbol cinta yang tulus dan abadi.\r\n\r\nDibungkus dengan kertas pink dan pita khas ilmisgarden, buket ini cocok untuk momen special seperti kejutan di Sebulan Penuh Cinta.\r\n\r\nAprox 40x20x50 xm', 'Bouquet', 'Gompie,Lilly,Rose', 'Birthday,Graduation,Valentine,Sebulan Penuh Cinta', 0),
(83, 'Sunny Love Bouquet', 480000, 'Sunny Love Bouquet memancarkan pesona ceria dengan sentuhan lembut dan modern. Rangkaian bunga sunflower berwarna kuning tampil manis dipadukan dengan daun parvi dan baby breath segar yang memberi kesan seimbang dan elegan. Ornamen berbentuk hati berwarna pink menambah nuansa romantis tanpa berlebihan.\r\n\r\nDibalut wrapping hijau sage dan pita pink khas ilmisgarden, buket ini melambangkan kasih sayang, kebahagiaan, dan perhatian yang hangat, sempurna untuk hadiah manis di momen Sebulan Penuh Cinta.\r\n\r\nAprox 30x20x40 cm.', 'Bouquet', 'Sunflower', 'Birthday,Valentine,Sebulan Penuh Cinta', 0),
(84, 'Choco Single Flower', 90000, 'Choco Single Flower merupakan rangkaian hadiah manis yang memadukan keindahan bunga segar dengan sentuhan coklat favorit. \r\n\r\nTambahan coklat serta ornamen hati berwarna pink memperkuat nuansa romantis dan sweet.\r\n\r\nAprox 15x7x25 cm.', 'Add-on,Bouquet', 'Gerbera,Rose', 'Birthday,Graduation,Valentine,Sebulan Penuh Cinta', 0),
(85, 'Sweet Classic Bloombox', 1000000, 'Sweet Classic Bloombox adalah rangkaian bunga elegan dengan sentuhan romantis klasik yang memikat. Dipenuhi oleh mawar pink lembut yang tersusun rapi membentuk tampilan penuh dan mewah, rangkaian ini dipadukan dengan lily putih anggun yang memberikan kesan bersih, feminin, dan berkelas. Ornamen hati menambah nuansa cinta yang manis dan modern.\r\n\r\nPerpaduan warna pastel dan bunga premium menjadikan rangkaian ini simbol kasih sayang yang timeless dan penuh makna.\r\n\r\nAprox 40x40x60 cm.', 'Box', 'Lilly,Rose', 'Anniversary,Birthday,Valentine,Sebulan Penuh Cinta', 0),
(86, 'Sweet Pebby Bloom', 620000, 'Sweet Pebby Bloom adalah rangkaian bunga bernuansa lembut dan romantis yang memadukan keindahan bunga mawar sweet pink yang mekar sempurna, gerbera putih, juga sentuhan carnation pink yang menciptakan kesan romantis, dan manis dari boneka.\r\n\r\nRangkaian ini cocok untuk melengkapi moment romantis dengan orang tersayang di Sebulan Penuh Cinta.\r\n\r\nAprox 40x15x50 cm.', 'Add-on,Box', 'Gerbera,Rose', 'Birthday,Valentine,Sebulan Penuh Cinta', 0),
(87, 'Brownies and Bloom', 270000, 'Brownies and Bloom adalah rangkaian hadiah manis yang memadukan keindahan bunga mawar segar dan gerbera pink yang manis, dengan sajian brownies lezat dalam satu kemasan elegan.\r\n\r\nDikemas dalam cup holder pink minimalis dengan tambahan cup brownies yang praktis dan estetik, serta dihiasi pita hitam dan pink yang elegan.\r\n\r\nAprox 20x10x30 cm.', 'Add-on', 'Gerbera,Rose', 'Birthday,Gift,Valentine,Sebulan Penuh Cinta', 0),
(88, 'Fortune Basket', 565000, 'Rangkaian Fortune Basket ini memadukan keindahan bunga segar dengan simbol kemakmuran dalam satu keranjang anyaman yang elegan. Perpaduan bunga dan buah jeruk segar tersusun rapi di dalam basket sebagai simbol rezeki, kelimpahan, dan harapan baik, dilengkapi daun hias serta ornamen bambu dan gantungan khas yang memperkuat nuansa tradisional penuh makna.\r\n\r\nAprox 30x10x50 cm.', 'Add-on,Basket', 'Gerbera,Gompie', 'Imlek', 0),
(89, 'Golden Harmony Bloombox', 720000, 'Rangkaian Golden Harmony Bloombox menghadirkan perpaduan harmonis antara keindahan bunga dan simbol keberuntungan dalam balutan desain modern bernuansa oriental. Disusun dengan bunga heliconia, krisan kuning, gerbera, dan mawar kuning yang memancarkan kesan hangat, optimisme, serta kemakmuran. Aksen bambu hijau yang berdiri kokoh melambangkan pertumbuhan dan keseimbangan, dilengkapi ornamen gantung khas sebagai simbol keberuntungan dan doa baik.\r\n\r\nDikemas dalam bloombox berwarna cokelat keemasan yang memberi sentuhan eksklusif dan berkelas, rangkaian ini cocok untuk ucapan Imlek atau hadiah istimewa yang sarat makna keharmonisan, kesuksesan, dan kelimpahan.\r\n\r\nAprox 40x15x60 cm.', 'Box', 'Gerbera,Gompie,Rose', 'Imlek', 0),
(90, 'Imperial Luck Arrangement', 1680000, 'Rangkaian Imperial Luck Arrangement memancarkan kemewahan klasik berpadu dengan simbol keberuntungan dan kemakmuran. Disusun dengan bunga anggrek yang menjadi highlight dan memberikan kesan mewah. Aksen bambu alami yang menjulang memberikan makna keteguhan dan pertumbuhan, sementara ornamen gantung bernuansa oriental melengkapi rangkaian dengan doa keberuntungan dan keseimbangan energi positif.\r\n\r\nAprox 30x30x70 cm.', 'Box', 'Gerbera,Gompie,Rose,Orchid', 'Imlek', 0),
(91, 'Mubarak Lux Box', 1800000, 'Rangkaian Mubarak Lux Box ini memadukan keindahan bunga anggrek biru yang lembut dipadukan dengan bunga ranunculus, mawar putih, gompie, serta sentuhan greenery yang memberikan kesan segar dan elegan. Nuansa warna biru dan putih menghadirkan suasana yang tenang, bersih, dan penuh kehangatan—selaras dengan makna Idul Fitri sebagai momen kembali kepada kesucian.\r\n\r\nSemua bunga dirangkai dalam box biru pastel dan dipadukan dengan Kue khas Lebaran, Reed Diffuser, dan Floral Tea.\r\n\r\nAprox 60x30x70 cm.', 'Add-on,Box', 'Gompie,Rose,Orchid', 'Raya,Eid Al Fitr', 0),
(92, 'Silaturahmi in Bloom', 1400000, 'Rangkaian Silaturahmi in Bloom menghadirkan perpaduan bunga bernuansa putih lembut seperti bunga ranunculus, mawar, gompie, dan anthurium dipadukan dengan sentuhan greenery yang memberikan kesan bersih, tenang, dan penuh kehangatan. Komposisi bunga yang tertata natural menciptakan tampilan yang anggun sekaligus menyegarkan.\r\n\r\nRangkaian ini ditempatkan dalam box biru pastel eksklusif dengan sentuhan pita signature, dipadukan dengan hampers pilihan seperti Kue khas lebaran, Reed diffuser, dan Floral tea yang tersusun rapi di atas alas hitam elegan. Perpaduan warna putih–biru menghadirkan nuansa modern minimalis dengan sentuhan luxury.\r\n\r\nDetail:\r\n5 tangkai ranunculus\r\n2 tangkai sedap malam\r\n4 tangkai daun silver dollar\r\n2 tangkai baby breath\r\n2 tangkai ammimajus\r\n2 tangkai anthurium\r\n3 tangkai gompie\r\n2 kue lebaran 400 ml (bisa request nastar, kaastengel, putri salju)\r\n1 reed diffuser 150 ml \r\n1 floral tea camovender isi 5 pcs\r\n\r\nTinggi bloom box ± 50 - 60 cm.\r\nLebar bloom box ± 40 cm.', 'Add-on,Box', 'Gompie,Rose', 'Raya,Eid Al Fitr', 0),
(93, 'Cookies and Bloom', 270000, 'Rangkaian Cookies and Bloom memadukan mawar putih, tuberose, dan sentuhan eucalyptus yang memberikan kesan segar serta menenangkan. Warna putih yang mendominasi melambangkan ketulusan, kedamaian, dan kehangatan dalam berbagi, sementara tekstur bunga yang berlapis menciptakan tampilan yang anggun dan natural.\r\n\r\nDi sisi box, terdapat jar Kue khas Lebaran. Aksen pita hitam–putih signature memperkuat identitas brand dan memberi sentuhan sophisticated.\r\n\r\nAprox ', 'Add-on', 'Rose', 'Gift,Raya,Eid Al Fitr', 0),
(94, 'Tuberose Vase', 810000, 'Rangkaian bunga ini menampilkan keindahan sedap malam putih yang tersusun anggun dalam vas kaca transparan, menghadirkan kesan bersih, tenang, dan elegan. Kelopak bunganya yang lembut dengan warna putih murni melambangkan ketulusan, harapan, serta kehangatan hati, sementara sentuhan daun hijau memberi keseimbangan alami yang menyegarkan. Dengan tampilan yang minimalis namun berkelas, rangkaian ini cocok menjadi simbol doa baik, ketenangan, dan perhatian tulus bagi seseorang yang istimewa.\r\n\r\n*bisa request jenis dan jumlah bunga sesuai yang tersedia.\r\n\r\nAprox 20x20x60 cm.', 'Vase', NULL, 'Raya,Eid Al Fitr', 0),
(107, 'Red Classic Bouquet', 300000, 'Red Classic Bouquet adalah rangkaian mawar merah yang memancarkan pesona misterius dan elegan. Warna merah pekatnya melambangkan gairah, kekuatan, dan cinta yang mendalam, sempurna untuk mengungkapkan perasaan intens dengan sentuhan kemewahan dan keanggunan klasik.\r\n\r\nBouquet ini cocok untuk mengungkapkan perasaan yang kuat dan tulus dan baik seperti, anniversary, valentine, lamaran, maupun momen spesial yang penuh makna. Tampilan yang classy dan timeless menjadikannya pilihan aman namun tetap berkesan untuk berbagai kesempatan romantis.\r\n\r\nTinggi bouquet ± 45–50 cm.', 'Best Seller,Bouquet', 'Rose', 'Anniversary,Birthday,Valentine,Wedding', 0),
(108, 'Sweet Classic Bouquet', 250000, 'Sweet Classic Bouquet dengan nuansa soft pink yang manis dan elegan, dirangkai dari pink rose segar sebagai bunga utama yang dipadukan dengan baby breath serta sentuhan daun ruscus hijau. \r\n\r\nKombinasi ini memberikan kesan lembut, romantis, dan timeless, ditambah dengan wrapping warna pastel yang clean dan pita khas ilmisgarden yang membuat tampilannya terlihat lebih premium dan siap dijadikan hadiah spesial. \r\n\r\nBuket ini cocok untuk berbagai momen seperti ulang tahun, anniversary, graduation, atau sebagai bentuk perhatian manis untuk orang tersayang. \r\n\r\nAprox 30x20x30 cm.', 'Best Seller,Bouquet', 'Rose', 'Anniversary,Birthday,Valentine', 0),
(109, 'Rose Amour Bouquet', 610000, 'Rose Amour adalah buket dengan kombinasi red rose dan white rose segar yang dipadukan dengan filler caspea untuk memberi tekstur yang lebih hidup. Perpaduan ini menciptakan kesan romantis, hangat, dan mewah, ditambah dengan wrapping hitam serta pita merah khas ilmisgarden yang membuat tampilannya terlihat premium. \r\n\r\nBuket ini sangat cocok untuk momen spesial seperti anniversary, romantic gift, valentine, atau ungkapan perasaan yang tulus dan mendalam. \r\n\r\nAprox 40x20x50 cm.', 'Best Seller,Bouquet', 'Rose', 'Anniversary,Birthday,Valentine', 0),
(110, 'Small White Rose Bouquet', 285000, 'Rangkaian ini terdiri dari white rose segar yang dipadukan dengan filler bunga kecil dan sentuhan daun ruscus hijau yang memberikan kesan fresh dan clean. Di bagian tengah, terdapat boneka Bity Toga, menjadikan buket ini terasa lebih spesial dan penuh makna untuk momen kelulusan.\r\n\r\nCocok untuk hadiah graduation, sebagai bentuk apresiasi atas pencapaian, atau ungkapan bangga untuk orang tersayang.\r\n\r\nAprox 40x20x50 cm.', 'Add-on,Bouquet', 'Rose', 'Graduation', 0),
(111, 'Lily Gerbera Bouquet', 1150000, 'Buket ini menghadirkan perpaduan warna yang cerah dan penuh energi, dirangkai dari kombinasi pink lily, gerbera, dan filler seperti baby breath serta pom-pom yang memberikan tekstur lebih hidup. Sentuhan daun eucalyptus menambah kesan fresh dan natural, sementara kehadiran boneka Bity Toga membuat buket ini terasa lebih spesial dan penuh makna. \r\n\r\nBouquet ini cocok untuk graduation, sebagai hadiah untuk merayakan pencapaian dan momen bahagia orang tersayang.\r\n\r\nAprox 80x40x100 cm.\r\n', 'Add-on,Bouquet', 'Gerbera,Gompie,Lilly,Pom-pom,Rose', 'Birthday,Graduation,Valentine', 0),
(112, 'Rosy Lily Bouquet', 335000, 'Buket ini menghadirkan perpaduan warna yang cantik dan berkarakter, dirangkai dari pink lily, red rose, serta gompie yang memberikan sentuhan manis dan tekstur yang unik. Dilengkapi dengan filler bunga kecil dan daun hijau segar, rangkaian ini terasa lebih hidup dan seimbang antara kesan romantic dan cheerful. \r\n\r\nCocok untuk berbagai momen spesial seperti ulang tahun, anniversary, atau sebagai ungkapan perhatian untuk orang tersayang\r\n\r\nAprox 40x20x50 cm.', 'Bouquet', 'Gompie,Lilly,Rose', 'Anniversary,Birthday,Graduation,Valentine', 0),
(113, 'Navy Royale Bouquet', 750000, 'Navy Royale Bouquet ini menghadirkan perpaduan warna yang mewah, dirangkai dari kombinasi navy rose dan white rose segar yang dipadukan dengan baby’s breath serta sentuhan eucalyptus untuk memberi kesan elegan dan modern. Dilengkapi dengan aksen boneka Tiny Toga dan Topper Toga, buket ini terasa lebih spesial dan penuh makna untuk graduation.\r\n\r\nDibalut dengan wrapping dark navy serta pita khas ilmisgarden, tampilannya terlihat premium, eksklusif, dan berkesan. Bouquet ini cocok untuk graduation, sebagai hadiah istimewa untuk merayakan kelulusan orang tersayang dengan cara yang elegan dan memorable.\r\n\r\nAprox 90x40x90 cm.', 'Add-on,Bouquet', 'Rose', 'Anniversary,Birthday,Graduation', 0),
(114, 'Blush and Shine Bouquet', 500000, 'Buket ini menghadirkan perpaduan warna cerah dan manis yang penuh energi positif, dirangkai dari bunga matahari yang melambangkan kebahagiaan serta dipadukan dengan pink rose dan pink gompie yang memberikan sentuhan lembut dan feminin. Kombinasi warna kuning dan pink menciptakan kesan fresh, cheerful, dan hangat, dilengkapi dengan filler bunga kecil serta daun hijau segar agar rangkaian terlihat lebih hidup dan seimbang. Dilengkapi dengan aksen Topper graduation, buket ini terasa lebih spesial dan penuh makna.\r\n\r\nDibalut dengan wrapping pilihan khas ilmisgarden, buket ini tampil cantik, manis, dan tetap premium. Bouquet ini cocok untuk birthday, graduation, ucapan semangat, anniversary, atau hadiah spesial untuk orang tersayang.\r\n\r\nAprox 40x20x50 cm.', 'Add-on,Bouquet', 'Gompie,Rose,Sunflower', 'Birthday,Graduation', 0),
(115, 'Victory Bloom Bouquet', 425000, 'Victory Bloom Bouquet menghadirkan perpaduan warna merah dan pink yang bold namun manis, dirangkai dari red rose segar yang melambangkan cinta dan kebanggaan, dipadukan dengan dianthus pink serta bunga pom-pom yang memberikan sentuhan lembut dan tekstur cantik. Kombinasi warna yang cerah menciptakan kesan hangat, joyful, dan penuh semangat.\r\n\r\nDibalut dengan wrapping merah maroon yang elegan serta aksen topper graduation, buket ini terlihat premium dan berkesan. Bouquet ini cocok untuk graduation, sebagai hadiah spesial untuk merayakan pencapaian dan momen kelulusan orang tersayang.\r\n\r\nAprox 40x20x60 cm.', 'Add-on,Bouquet', 'Dianthus,Pom-pom,Rose', 'Birthday,Graduation', 0),
(116, 'Graduation Glory', 505000, 'Rangkaian ini menghadirkan perpaduan elegan dan manis dalam bentuk box arrangement yang mewah, dirangkai dari pink lily yang anggun, white rose segar, pom-pom pink, serta bunga filler bernuansa lembut yang memberikan tampilan penuh dan bertekstur cantik. Sentuhan eucalyptus menambah kesan fresh dan modern, Boneka Bity toga dengan aksen Topper graduation menjadikan rangkaian ini terasa lebih spesial dan penuh makna.\r\n\r\nDisusun dalam box premium khas ilmisgarden dengan pita signature yang elegan, rangkaian ini tampil eksklusif dan berkelas. Cocok sebagai hadiah graduation untuk merayakan pencapaian dan momen kelulusan orang tersayang dengan cara yang manis dan memorable.\r\n\r\nAprox 40x15x50 cm.', 'Add-on,Box', 'Lilly,Pom-pom,Rose', 'Graduation', 0),
(117, 'Joyful Bloom Bouquet', 320000, 'Joyful Bloom Bouquet menghadirkan perpaduan warna segar dan ceria, dirangkai dari kombinasi gerbera putih dan orange, aster kuning, carnation putih, serta sentuhan ammimajus dan ruscus yang memberi kesan natural dan fresh. Aksen topper silhouette graduation dengan detail tassel emas menjadikan buket ini terlihat unik, elegan, dan penuh makna. \r\n\r\nDibalut wrapping mint green dengan pita orange dan signature ribbon khas ilmisgarden, tampilannya manis, modern, dan berkelas. Bouquet ini cocok untuk graduation, sebagai hadiah spesial untuk merayakan pencapaian dan langkah baru orang tersayang dengan kesan cerah dan memorable.\r\n\r\nAprox 40x20x50 cm.', 'Add-on,Bouquet', 'Gerbera', 'Graduation', 0),
(118, 'Maroon Blush Bouquet', 410000, 'Maroon Blush Bouquet menghadirkan perpaduan warna burgundy, merah, pink yang mewah serta berkelas. Dirangkai dari kombinasi red rose, dianthus pink, gompie, calla lily, serta sentuhan filler calimero yang memberi tekstur cantik dan tampilan penuh. Aksen topper silhouette graduation menjadikan buket ini terasa lebih spesial dan penuh makna untuk merayakan pencapaian penting. \r\n\r\nDibalut wrapping maroon dan hitam dengan pita signature khas ilmisgarden, tampilannya terlihat bold, elegan, dan premium. Bouquet ini cocok untuk graduation, sebagai hadiah istimewa untuk merayakan kelulusan orang tersayang dengan kesan mewah, manis, dan memorable.\r\n\r\nAprox 40x20x60cm.', 'Add-on,Bouquet', 'Dianthus,Gompie,Rose', 'Graduation', 0),
(119, 'Gradua Luxe', 1250000, 'Rangkaian bloom box eksklusif bernuansa hangat dan berkelas, memadukan paper peony, paper rose, paper cosmos, cherry blossom, serta sentuhan amaranthus yang menjuntai anggun. Dilengkapi frame foto dan elemen tassel wisuda, rangkaian ini menjadi simbol pencapaian, kebanggaan, dan awal perjalanan baru. Dominasi warna peach, maroon, dan gold menciptakan kesan elegan serta mewah. Cocok sebagai hadiah wisuda istimewa untuk momen yang tak terlupakan.\r\n\r\nAprox 40x20x60cm.', 'Add-on,Box,Dried Flowers', NULL, 'Graduation,Gift', 0),
(120, 'Lilac Skies Bouquet', 300000, 'Lilac Skies Bouquet menghadirkan perpaduan warna pastel yang lembut dan elegan, dirangkai dari ocean song rose, blue hydrangea, white carnation, serta aster sebagai filler yang memberi tampilan manis dan berkelas. Kombinasi warna ungu muda, biru, dan putih menciptakan kesan anggun, fresh, dan menenangkan. Dilengkapi topper graduation serta dibalut wrapping premium dengan sentuhan lilac dan pita signature khas ilmisgarden, buket ini terlihat mewah dan istimewa. \r\n\r\nBouquet ini cocok untuk graduation, sebagai hadiah spesial untuk merayakan kelulusan orang tersayang dengan kesan lembut, cantik, dan memorable.\r\n\r\nAprox 40x20x50cm.', 'Add-on,Bouquet', 'Hydrangea,Rose', 'Graduation', 0),
(121, 'Petite Rose Bouquet', 125000, 'Petite Rose Bouquet dengan 3 tangkai mawar pilihan yang dirangkai manis dalam ukuran mungil dan elegan. Simbol kasih sayang, perhatian, dan ketulusan, rangkaian sederhana ini cocok untuk hadiah kecil yang berkesan. Dengan tampilan minimalis namun tetap anggun, buket ini sempurna untuk ucapan terima kasih, ulang tahun, wisuda, atau kejutan manis di hari spesial.', 'Add-on,Bouquet', 'Rose', 'Anniversary,Birthday,Graduation', 0),
(122, 'Mint Blush Bouquet', 420000, 'Perpaduan elegan white rose yang melambangkan ketulusan dan pink lily yang memancarkan pesona anggun, dirangkai manis dengan sentuhan baby breath serta ruscus segar. Dibalut wrapping soft blue dan pita dusty pink, buket ini menghadirkan kesan lembut, mewah, dan menenangkan. Cocok untuk hadiah wisuda, ulang tahun, anniversary, maupun ungkapan kasih sayang spesial.\r\n\r\nAprox 50x25x50cm', 'Bouquet', 'Lilly,Rose', 'Birthday,Graduation,Valentine', 0),
(123, 'Midnight Dried Bouquet', 450000, 'Rangkaian dried bouquet bernuansa hitam dan putih yang memancarkan kesan bold, elegan, dan timeless. Perpaduan paper rose putih, dried rose eksklusif, caspea, dried baby breath, bunny tail, serta sentuhan foliage artistik menciptakan tampilan mewah dengan karakter yang unik. Dibalut wrapping hitam-putih premium, buket ini cocok sebagai hadiah berkelas, dekorasi estetik, maupun ungkapan spesial yang tahan lama dan berkesan.\r\n\r\nAprox 50x20x60cm.', 'Bouquet,Dried Flowers', NULL, 'Birthday,Graduation', 0),
(124, 'Money Choco Bouquet', 205000, 'Money Choco Bouquet perpaduan 10 lembar uang dan 5 cokelat SilverQueen, dirangkai manis dalam balutan wrapping biru pastel yang fresh dan elegan. Kombinasi hadiah praktis dan manis ini melambangkan doa keberuntungan, kelimpahan, serta kebahagiaan. Cocok untuk ulang tahun, wisuda, anniversary, atau kejutan spesial bagi orang tersayang dengan sentuhan kreatif yang berkesan.\r\n\r\nAprox 30x20x30 cm.', 'Add-on,Bouquet', NULL, 'Anniversary,Birthday,Graduation,Gift', 0),
(125, 'Pink Melody Bouquet', 375000, 'Pink Melody Bouquet ini memadukan lily pink dan mawar cherry o dalam harmoni warna yang hidup dan manis, menghadirkan kesan cheerful, romantic, dan penuh kebahagiaan.\r\nCocok untuk merayakan momen spesial, ungkapan cinta, atau sekadar mengirimkan senyuman.\r\n\r\nAprox 30x20x40 cm.', 'Bouquet', 'Lilly,Rose', 'Birthday,Graduation,Valentine', 0),
(126, 'Dark Cheer Bouquet', 375000, 'Rangkaian bouquet ini bernuansa bold dan elegan dengan perpaduan lily pink, mawar candy, gerbera merah, pompom ungu, serta sentuhan daun parvi, menciptakan tampilan kontras yang romantis, sedikit misterius, namun tetap memikat dan penuh karakter.\r\nCocok untuk momen spesial yang ingin terasa lebih berani dan berkesan.\r\n\r\nAprox 40x20x50 cm.', 'Bouquet', 'Gerbera,Lilly,Pom-pom,Rose', 'Birthday,Graduation', 0),
(127, 'Peach Blossom Bouquet', 500000, 'Rangkaian bouquet bernuansa soft romantic ini memadukan lily putih, mawar peach, carnation pink, dan sentuhan baby breath biru dalam harmoni warna yang lembut dan menenangkan, menghadirkan kesan feminine, hangat, dan dreamy.\r\nSempurna untuk ulang tahun, anniversary, wisuda, atau ungkapan kasih sayang yang tulus.\r\n\r\nAprox 50x30x50 cm.', 'Bouquet', 'Lilly,Rose', 'Birthday,Graduation', 0),
(128, 'Peach Shinee on Vase', 430000, 'Rangkaian bunga dalam vase dengan nuansa peach dan kuning yang lembut, dipadukan dengan wrapping transparan untuk tampilan baru dan modern, menghadirkan kesan hangat, cheerful, dan elegan.\r\nCocok untuk hadiah ulang tahun, ucapan selamat, atau momen spesial yang penuh kebahagiaan.\r\n\r\nAprox 30x20x30 cm.', 'Vase', 'Gerbera,Rose', 'Birthday,Grand Opening,Gift', 0),
(129, 'Money Rose Royale Bouquet', 470000, 'Money Rose Royale Bouquet perpaduan 30 lembar uang dan bunga mawar merah, carnation pink, dan filler lainnya. Dibalut wrapping coral dengan pita signature khas ilmisgarden, tampilannya terlihat elegan dan premium.\r\n\r\nBouquet ini cocok untuk ulang tahun, wisuda, anniversary, atau kejutan spesial bagi orang tersayang.\r\n\r\nAprox 40x20x50 cm.\r\n', 'Money Bouquet', 'Rose', 'Anniversary,Birthday,Graduation,Gift', 0),
(130, 'Standing Flower Bloombox', 1150000, 'Rangkaian Standing Flower dengan konsep Bloombox modern yang memberikan tampilan lebih premium, clean, dan eksklusif. Dirangkai dengan perpaduan lily putih, mawar putih, ammimajus, filler baby breath yang memberikan tampilan penuh dan bertekstur cantik, serta daun nandina dan andong menambah kesan fresh dan natural. \r\n\r\nStanding Flower ini cocok untuk ucapan selamat, opening event, atau bentuk apresiasi spesial.\r\n\r\nAprox 40x30x160 cm.', 'Standing Flowers', 'Lilly,Rose', 'Grand Opening', 0),
(131, 'Standing Flower Wreath', 1200000, 'Rangkaian Standing Flower Wreath bernuansa putih dan hijau. Dirangkai dengan perpaduan lily putih, mawar putih, ammimajus, dianthus hijau, aster putih yang memberikan tampilan penuh dan bertekstur cantik, serta daun nandina dan palem menambah kesan fresh dan natural.\r\n\r\nMenggunakan standing kayu sebagai simbol ketulusan dan penghormatan, cocok sebagai ungkapan duka cita yang elegan dan penuh makna.\r\n\r\nAprox 60x60 cm.', 'Standing Flowers', 'Dianthus,Lilly,Rose', NULL, 0),
(132, 'Veloura Amethyst Standing Flower', 2500000, 'Standing flower bernuansa ungu, pink, dan lilac dengan perpaduan orchid, lily pink, mawar dolcetto, anthurium, krisan, mums peony, hingga sentuhan daun palem kipas yang memberikan kesan mewah, dan elegant. Dirangkai menggunakan standing kayu cocok digunakan sebagai ucapan ulang tahun, grand opening, celebration event, maupun bentuk apresiasi spesial dengan tampilan yang bold dan berkesan.\r\n\r\napprox 90×30×130 cm.', 'Standing Flowers', 'Gompie,Lilly,Rose,Orchid', 'Grand Opening', 0),
(133, ' Blooming Canvas Lilac Reverie', 1000000, 'Rangkaian bunga perpaduan warna lilac, biru, dan sentuhan hangat orange yang dirangkai di atas canvas sebagai simbol momen yang manis dan berkesan. Hadir dengan tampilan artistic dan elegan. Dirancang dengan detail warna yang lembut dan dreamy, Lilac Reverie membawa nuansa romantis yang tenang sekaligus timeless dalam satu rangkaian.\r\n\r\nBlooming Canvas ini cocok digunakan sebagai wedding greeting, hadiah spesial, maupun dekorasi untuk merayakan hari istimewa.\r\n\r\nAprox 60x150 cm.', 'Artificial Flowers,Best Seller,Standing Flowers', NULL, 'Grand Opening,Wedding', 0),
(134, ' Blooming Canvas Serena Verde', 1000000, 'Blooming canvas bernuansa putih, sage, dan hijau tropikal dengan perpaduan artificial mawar putih, calla lily, carnation, aster, serta sentuhan artificial palm dan monstera yang memberikan kesan clean, elegant, dan sophisticated. Dilengkapi custom sticker ucapan dan standing kayu.\r\n\r\nRangkaian ini cocok digunakan sebagai ucapan selamat, grand opening, corporate greeting, opening store, maupun decorative welcome display dengan tampilan modern dan timeless.\r\n\r\nApprox 60 × 150 cm', 'Artificial Flowers,Standing Flowers', NULL, 'Grand Opening', 0),
(135, 'Standing Flower Peach Whisper', 1000000, 'Standing flower bernuansa soft peach dan putih dengan tampilan airy, clean, dan modern. Kombinasi peach rose, white gerbera, aster, serta ammimajus menciptakan rangkaian yang manis dan elegant dengan sentuhan natural greenery.\r\n\r\nCocok untuk opening store, wedding congratulation, birthday celebration, ataupun bentuk appreciation gift.\r\n\r\nAprox 90x30x130 cm.', 'Standing Flowers', 'Gerbera,Rose', 'Grand Opening', 0),
(136, 'Golden Rosé Garden', 1000000, 'Standing flower perpaduan mawar peach, mawar merah, gerbera kuning, dan gladiol dalam nuansa hangat yang cheerful dan elegan. Dilengkapi sentuhan solidago serta daun pakis yang memberi kesan fresh dan penuh volume.\r\n\r\nCocok digunakan untuk grand opening, congratulation, celebration, ataupun corporate gifting.\r\n\r\nAprox 90x30x130 cm.', 'Standing Flowers', 'Gerbera,Rose', 'Grand Opening', 0),
(137, 'Blush Petaline Bloombox', 220000, 'Blush Petaline Bloombox bernuansa soft pink dan lilac dengan perpaduan mawar pink, chrysanthemum, calimero, carnation, serta sentuhan ruscus yang memberikan kesan sweet, cheerful, dan feminine.\r\n\r\nRangkaian ini cocok untuk birthday gift, graduation, bridesmaid gift, hingga bentuk perhatian manis untuk orang tersayang dengan tampilan yang lembut dan charming.\r\n\r\nApprox 20×20×40 cm.', 'Box', 'Rose', 'Birthday', 0),
(138, 'Pink Roselle Bouquet', 325000, 'Pink Roselle Bouquet bernuansa soft pink dengan perpaduan mawar pink, gerbera pink, carnation pink, chrysanthemum, serta sentuhan silver dollar yang memberikan kesan cheerful, romantic, dan sweet feminine.\r\n\r\nDibalut dengan wrapping peach pink, rangkaian ini cocok untuk birthday gift, graduation, anniversary, bridesmaid bouquet, maupun hadiah manis untuk orang tersayang dengan tampilan yang fresh dan charming.\r\n\r\nApprox 40 × 20 × 50 cm', 'Bouquet', 'Gerbera,Rose', 'Birthday,Graduation', 0),
(139, 'Pinkies Lilac Bouquet', 500000, 'Pinkies Lilac Bouquet menghadirkan perpaduan warna pastel yang lembut dan elegan, dirangkai dari matthiola ungu, mawar dolcetto, mawar putih, gompie pink, carnation putih, serta baby breath sebagai filler yang memberi tampilan manis dan berkelas. Kombinasi warna ungu, pink dan putih menciptakan kesan anggun, fresh, dan menenangkan. Dibalut wrapping warna putih dan pita signature khas ilmisgarden, buket ini terlihat mewah dan istimewa.\r\n\r\nBouquet ini cocok untuk birthday, graduation, anniversary, maupun ungkapan kasih sayang spesial.\r\n\r\nAprox 80x40x100 cm.', 'Bouquet', 'Gompie,Rose', 'Birthday,Graduation', 0),
(140, 'Blush Limonetta Bouquet', 750000, 'Blush Limonetta Bouquet adalah rangkaian bouquet bernuansa soft romantic ini memadukan lily putih, mawar pink, mawar mohana, carnation pink, dan sentuhan baby breath biru dalam harmoni warna yang lembut dan menenangkan, menghadirkan kesan feminine, hangat, dan dreamy.\r\nSempurna untuk ulang tahun, anniversary, wisuda, atau ungkapan kasih sayang yang tulus.\r\n\r\nAprox 40x20x50 cm.', 'Bouquet', 'Lilly,Rose', 'Birthday,Graduation', 0),
(141, 'Custom Photo Bouquet', 190000, 'Custom Photo Bouquet adalah rangkaian foto yang disusun manis dan rapih. Bouquet ini cocok untuk ulang tahun, wisuda, perpisahan kelas, kado untuk guru dengan sentuhan kreatif yang berkesan.\r\n\r\nAprox 40x20x50 cm.', 'Bouquet', NULL, NULL, 0),
(142, 'Skies Lily Bouquet', 350000, 'Perpaduan elegan white rose yang melambangkan ketulusan dan pink lily yang memancarkan pesona anggun, dirangkai manis dengan sentuhan baby breath serta ruscus segar. Dibalut wrapping soft blue, buket ini menghadirkan kesan lembut, mewah, dan menenangkan. Cocok untuk hadiah wisuda, ulang tahun, anniversary, maupun ungkapan kasih sayang spesial.\r\n\r\nAprox 30x20x40cm', 'Bouquet', 'Lilly,Rose', 'Birthday,Graduation,Raya,Eid Al Fitr', 0),
(143, 'Midnight Purple Bouquet', 285000, 'Rangkaian bouquet ini bernuansa bold dan elegan dengan perpaduan mawar dolcetto, pompom ungu, carnation pink, calimero ungu, serta sentuhan daun silver dollar yang diberi warna hitam, menciptakan tampilan kontras yang romantis, sedikit misterius, namun tetap memikat dan penuh karakter.\r\nCocok untuk momen spesial yang ingin terasa lebih berani dan berkesan.\r\n\r\nAprox 40x20x50 cm.', 'Bouquet', 'Pom-pom,Rose', 'Birthday,Graduation', 0),
(144, 'Golden Eclair Bloombox', 500000, 'Bloombox bernuansa gold, bronze, peach, dan ivory dengan perpaduan mawar gold, mawar peach, gerbera putih, carnation, baby breath, serta sentuhan parvi yang memberikan kesan elegan, warm, dan classy. Rangkaian ini menghadirkan tampilan soft luxury yang tetap fresh dan timeless.\r\n\r\nRangkaian ini cocok digunakan untuk birthday gift, graduation, bridal shower, ucapan congratulations, anniversary, hingga corporate gifting.\r\n\r\nApprox 40 × 30 × 50 cm', 'Box', 'Gerbera,Rose', 'Birthday,Graduation', 0),
(145, 'Rose Amora Bloombox', 500000, 'Bloombox bernuansa cherry pink, soft pink, lilac, dan putih dengan perpaduan mawar cherry o, mawar baby love, mawar dolcetto, mawar putih, carnation, calimero, amimajus, serta sentuhan silver dollar eucalyptus yang memberikan kesan sweet, romantic, dan elegant. Dirangkai dalam medium bloombox putih dengan detail ribbon hitam dan pink yang membuat tampilannya terlihat manis namun tetap classy.\r\n\r\nRangkaian ini cocok digunakan untuk birthday gift, anniversary, graduation, bridal shower, hingga bentuk appreciation untuk orang tersayang.\r\n\r\nApprox 40×30×50 cm.', 'Box', 'Rose', 'Anniversary,Birthday,Graduation,Valentine', 0),
(146, 'Bluebell Teddy Bouquet', 445000, 'Bouquet bernuansa baby blue, putih. Perpaduan mawar biru, mawar putih, baby breath, caspea, serta teddy bear sebagai centerpiece yang memberikan kesan sweet, playful, dan comforting. Dirangkai dengan wrapping putih dan baby blue yang membuat tampilannya terlihat clean, soft, dan cheerful.\r\n\r\nRangkaian ini cocok digunakan untuk birthday gift, graduation, anniversary, surprise gift, hingga bentuk appreciation untuk orang tersayang. Kombinasi bunga biru dan teddy bear pada bouquet ini menghadirkan nuansa cute, calming, dan hangat dengan sentuhan manis khas ilmisgarden.\r\n\r\nApprox 50×40×70 cm.', 'Add-on,Bouquet', 'Rose', 'Anniversary,Birthday,Graduation,Gift,Valentine', 0),
(147, 'Peach Whisper Bouquet', 170000, 'Bouquet bernuansa peach dan putih dengan perpaduan mawar putih, gompie pink, aster, dan ruscus yang memberikan kesan manis, lembut, dan elegant. Dirangkai dengan wrapping peach pastel dan detail ribbon hitam putih yang membuat tampilannya terlihat simple namun tetap classy dan feminine.\r\n\r\nRangkaian ini cocok digunakan untuk birthday gift, graduation, bridesmaid bouquet, sweet gesture, hingga bentuk appreciation sederhana untuk orang tersayang. Kombinasi warna peach dan putih pada bouquet ini menghadirkan nuansa soft, warm, dan cheerful khas ilmisgarden.\r\n\r\napprox 30×20×40 cm.', 'Bouquet', 'Gompie,Rose', 'Birthday,Graduation', 0),
(148, 'Bubble Blue Bouquet', 340000, 'Bouquet bernuansa baby blue, soft pink, dan putih dengan perpaduan mawar biru, gerbera putih, dianthus pink, baby breath, dan ruscus yang memberikan kesan cheerful, sweet, dan fresh. Dirangkai dengan wrapping baby blue serta ribbon pink hitam yang membuat tampilannya terlihat playful namun tetap elegant dan soft.\r\n\r\nRangkaian ini cocok digunakan untuk birthday gift, graduation bouquet, celebration gift, hingga surprise untuk orang tersayang. Kombinasi warna biru pastel dan pink pada bouquet ini menghadirkan nuansa dreamy, calming, dan joyful khas ilmisgarden.\r\n\r\nApprox 40 × 20 × 50 cm.', 'Bouquet', 'Dianthus,Gerbera,Rose', 'Birthday,Graduation', 0),
(149, 'Ivory Bouquet', 199999, 'Bouquet bernuansa putih, ivory, dan soft cream dengan perpaduan mawar putih, gerbera putih, carnation putih, baby breath, dan ammimajus yang memberikan kesan clean, calm, dan timeless. Dirangkai menggunakan newspaper wrapping dengan sentuhan ribbon hitam putih yang membuat tampilannya terlihat rustic, warm, dan elegant.\r\n\r\nRangkaian ini cocok digunakan untuk graduation bouquet, birthday gift, appreciation gift, hingga bouquet wisuda atau celebration dengan tema minimalis dan natural. Dominasi warna putih pada bouquet ini menghadirkan nuansa sincere, soft, dan comforting khas ilmisgarden.\r\n\r\nApprox 40 × 20 × 50 cm.', 'Bouquet', 'Gompie,Rose', 'Anniversary,Birthday,Graduation', 0),
(150, 'Peachies Blush Bouquet', 300000, 'Bouquet bernuansa peach, soft pink, dan cream dengan perpaduan mawar peach, mawar pink, lily pink, carnation orange, baby breath, dan silver dollar yang memberikan kesan manis, hangat, dan elegant. Dirangkai menggunakan wrapping cream ivory dengan sentuhan ribbon pink hitam yang membuat tampilannya terlihat soft, feminine, dan timeless.\r\n\r\nRangkaian ini cocok digunakan untuk birthday bouquet, anniversary gift, graduation, hingga surprise untuk orang tersayang. Kombinasi warna peach dan pink pada bouquet ini menghadirkan nuansa cheerful, romantic, dan comforting khas ilmisgarden.\r\n\r\nApprox 40 × 20 × 50 cm.', 'Bouquet', 'Lilly,Rose', 'Birthday,Graduation', 0),
(151, 'Pink Daydream Bouquet', 500000, 'Bouquet bernuansa soft pink dengan perpaduan mawar pink, gerbera pink, gompie pink, carnation pink, dan sentuhan ruskus yang memberikan kesan manis, feminin, dan penuh keceriaan. Dirangkai menggunakan wrapping pink pastel dengan ribbon khas ilmisgarden yang membuat tampilannya terlihat dreamy, elegant, dan romantis.\r\n\r\nRangkaian ini cocok digunakan untuk birthday bouquet, anniversary gift, graduation, baby shower, bridal shower, maupun sebagai bentuk apresiasi untuk orang tersayang. Dominasi warna pink pada bouquet ini menghadirkan nuansa sweet, cheerful, dan affectionate yang mampu menyampaikan rasa sayang, kebahagiaan, dan perhatian dalam satu rangkaian yang berkesan.\r\n\r\nApprox 80 × 40 × 100 cm.', 'Best Seller,Bouquet', 'Gerbera,Gompie,Rose', 'Anniversary,Birthday,Graduation,Valentine,Sebulan ', 0),
(152, 'Mauve Melody Bouquet', 500000, 'Bouquet bernuansa lavender, soft pink, dan periwinkle blue dengan perpaduan hydrangea biru, mawar ocean song, mawar pink, gerbera pink, pompom momoko, calimero ungu, dan carnation pink yang memberikan kesan dreamy, graceful, dan romantic. Dirangkai menggunakan wrapping lilac dan blush pink yang membuat tampilannya terlihat mewah, lembut, dan penuh pesona.\r\n\r\nRangkaian ini cocok digunakan untuk birthday bouquet, anniversary gift, graduation, bridal shower, hingga hadiah spesial untuk seseorang yang menyukai warna-warna pastel yang elegan. Perpaduan warna ungu, pink, dan biru pada bouquet ini menghadirkan nuansa whimsical, charming, dan sophisticated yang mampu menciptakan kesan manis sekaligus berkelas dalam setiap momen.\r\n\r\nApprox 80 × 40 × 100 cm.', 'Bouquet', 'Gerbera,Hydrangea,Pom-pom,Rose', 'Birthday,Graduation', 0),
(153, 'Pink Lily Elegance', 500000, 'Bouquet bernuansa soft pink dan putih dengan perpaduan lily pink, mawar pink, statice, silver dollar, dan sentuhan foliage yang memberikan kesan anggun, mewah, dan feminin. Dirangkai menggunakan wrapping putih dan blush pink dengan ribbon khas ilmisgarden yang membuat tampilannya terlihat timeless, graceful, dan penuh pesona.\r\n\r\nRangkaian ini cocok digunakan untuk birthday bouquet, anniversary gift, graduation, bridal shower, ucapan selamat, maupun hadiah spesial untuk orang tersayang. Kehadiran bunga lily sebagai focal point dipadukan dengan mawar pink menciptakan nuansa romantic, elegant, dan sophisticated yang mampu menyampaikan rasa kasih sayang, kekaguman, dan doa terbaik dalam satu rangkaian yang berkesan.\r\n\r\nApprox 80 × 40 × 100 cm.', 'Bouquet', 'Lilly,Rose', 'Anniversary,Birthday,Graduation,Valentine', 0),
(154, 'Pink Lily Blossom', 350000, 'Bouquet bernuansa soft pink dan putih dengan dominasi pink lily, dipadukan dengan baby breath dan ruscus yang memberikan kesan anggun, segar, dan timeless. Dirangkai menggunakan wrapping putih dengan sentuhan blush pink serta ribbon khas ilmisgarden yang membuat tampilannya terlihat clean, elegant, dan feminin.\r\n\r\nRangkaian ini cocok digunakan untuk birthday bouquet, anniversary gift, graduation, bridal shower, ucapan selamat, maupun hadiah spesial untuk orang tersayang. Keindahan bunga lily yang melambangkan kemurnian dan harapan, dipadukan dengan baby breath sebagai simbol ketulusan, menciptakan rangkaian yang penuh makna serta mampu menyampaikan rasa kasih sayang, apresiasi, dan doa terbaik dalam satu bouquet yang berkesan.\r\n\r\nApprox 30 × 20 × 40 cm.', 'Best Seller,Bouquet', 'Lilly', 'Birthday,Graduation,Valentine', 0),
(155, 'Blush Blue Hydrangea Bouquet ', 250000, 'Bouquet bernuansa baby blue, soft pink, dan putih dengan perpaduan hydrangea, mawar pink, dianthus, aster putih, dan silver dollar yang menghadirkan kesan lembut, segar, dan elegan. Dirangkai menggunakan wrapping berwarna biru muda dengan sentuhan blush pink serta ribbon khas ilmisgarden, menciptakan tampilan yang manis, modern, dan penuh pesona.\r\n\r\nRangkaian ini cocok digunakan untuk birthday bouquet, anniversary gift, graduation, bridal shower, ucapan selamat, maupun hadiah spesial untuk orang tersayang. Keindahan hydrangea sebagai focal point dipadukan dengan mawar pink yang melambangkan kasih sayang dan kelembutan menghasilkan rangkaian yang memberikan nuansa romantic, graceful, dan sophisticated, sehingga mampu menjadi hadiah yang berkesan untuk berbagai momen istimewa.\r\n\r\nApprox 30 × 20 × 40 cm.', 'Bouquet', 'Dianthus,Hydrangea,Rose', 'Birthday,Graduation', 0),
(156, 'Rosalie Bloom', 145000, 'Perpaduan mawar pink, gerbera pink, aster pink, dan sentuhan ruscus menciptakan rangkaian bernuansa lembut yang manis dan elegan. Dominasi warna pastel memberikan kesan hangat, feminin, dan penuh kasih, sehingga cocok untuk merayakan ulang tahun, wisuda, anniversary, maupun sebagai ungkapan perhatian kepada orang terkasih. Hadir dengan tampilan yang simpel namun tetap berkelas.\r\n\r\nApprox 30 × 20 × 40 cm.', 'Bouquet', 'Gerbera,Rose', 'Birthday,Graduation', 0),
(157, 'Snow Lily Bouquet', 525000, 'Perpaduan bunga lily putih yang anggun dengan sentuhan baby breath dan parvi menciptakan rangkaian yang bersih, lembut, dan elegan. Lily menjadi focal point yang menghadirkan kesan mewah sekaligus menenangkan, sementara baby breath memberikan tekstur ringan yang mempermanis keseluruhan tampilan.\r\n\r\nDibalut dengan wrapping bernuansa putih dan hijau lembut, bouquet ini cocok untuk berbagai momen spesial seperti ucapan selamat, wisuda, ulang tahun, hingga ungkapan simpati. Sebuah rangkaian yang menghadirkan kesan tulus, tenang, dan berkelas dalam satu genggaman.\r\n\r\nApprox 40 × 20 × 50 cm.', 'Bouquet', 'Lilly', 'Birthday,Graduation,Raya,Valentine', 0),
(158, 'Verdant Grace Bloombox', 700000, 'Verdant Grace Bloombox menghadirkan perpaduan segarnya anggur hijau premium dengan rangkaian bunga bernuansa putih yang elegan. Mawar putih, gerbera putih, carnation, baby breath, dan parvi dirangkai dalam bloombox eksklusif dengan sentuhan pita emas, menciptakan kesan mewah sekaligus hangat.\r\n\r\nKombinasi buah dan bunga menjadikan rangkaian ini bukan hanya indah dipandang, tetapi juga bermakna sebagai simbol doa akan kemurnian, kesehatan, kelimpahan, dan harapan baik. Cocok diberikan untuk ucapan selamat, grand opening, ulang tahun, wisuda, perayaan, hingga sebagai hadiah untuk orang terkasih.\r\n\r\nAprox 40 x 25 x 30 cm.', 'Box', 'Gerbera,Rose', 'Birthday,Gift', 0),
(159, 'Peachy Wedding Bouquet', 435000, 'Peachy Wedding Bouquet merupakan arrangement bergaya round yang menghadirkan bentuk buket simetris, penuh, dan elegan. Perpaduan mawar peach, mawar putih, gerbera hijau, gompie putih, baby breath, serta silver dollar menciptakan rangkaian dengan nuansa fresh, natural, dan timeless.\r\n\r\nDirangkai dengan teknik round, setiap bunga ditempatkan secara seimbang sehingga menghasilkan siluet yang rapi dan harmonis dari berbagai sudut. Cocok dijadikan hadiah untuk ulang tahun, wisuda, anniversary, ucapan selamat, hingga momen spesial lainnya yang ingin dikenang dengan rangkaian bunga yang anggun.\r\n\r\nAprox 20 x 20 x 25 cm.', 'Wedding Bouquet', 'Gerbera,Gompie,Rose', 'Wedding', 0),
(160, 'Sweet Tuberose  Vase', 290000, 'Sweet Tuberose Vase merupakan arrangement vase berukuran small yang menampilkan sedap malam sebagai bunga utama, dipadukan dengan snapdragon, dianthus pink dan putih, aster pink, serta ruskus sebagai sentuhan foliage. Perpaduan warna pastel dan bentuk bunga yang bertingkat menciptakan rangkaian yang terlihat anggun, segar, dan penuh karakter.\r\n\r\nDirangkai dalam vas kaca minimalis, rangkaian ini cocok sebagai dekorasi meja, hadiah ulang tahun, housewarming, ucapan terima kasih, maupun sebagai bunga penyemangat untuk orang tersayang.\r\n\r\nAprox 15 x 15 x 30 cm.', 'Vase', 'Dianthus,Tuberose / Sedap Malam', 'Birthday,Raya,Eid Al Fitr', 0),
(161, 'Dusty Blue Peony Vase', 430000, 'Perpaduan artificial peony biru dusty sebagai bunga utama dengan mini peony biru, hydrangea putih, carnation putih, dan sentuhan eucalyptus menciptakan rangkaian dalam vas yang elegan dengan nuansa biru-putih yang menenangkan. Peony menjadi focal point yang memberikan kesan mewah dan berkelas, sementara hydrangea menghadirkan volume yang lembut, carnation menambah tekstur, serta eucalyptus memberikan sentuhan segar dan natural pada keseluruhan rangkaian.\r\n\r\nDisusun dalam vas kaca minimalis dengan pita biru khas Ilmisgarden, rangkaian ini cocok sebagai dekorasi meja, hadiah ulang tahun, housewarming, ucapan selamat, anniversary, maupun corporate gift. Kombinasi warna biru dan putih menghadirkan kesan modern, tenang, dan timeless sehingga mudah dipadukan dengan berbagai gaya interior.\r\n\r\nApprox 15 × 15 × 30 cm.', 'Artificial Flowers,Bouquet,Vase', NULL, 'Birthday,Graduation,Grand Opening', 0),
(162, 'Pink Stargazer Bouquet', 450000, 'Perpaduan lily pink yang mekar anggun dengan mawar merah, gompie pink, carnation pink, baby breath, dan ruskus menciptakan rangkaian yang romantis dengan sentuhan elegan. Lily menjadi focal point yang memancarkan kemewahan dan keanggunan, sementara mawar merah melambangkan cinta dan ketulusan. Gompie serta carnation memberikan tekstur yang lembut sehingga bouquet tampak lebih penuh dan harmonis.\r\n\r\nDibalut dengan wrapping bernuansa dusty pink dan dihiasi pita merah yang manis, bouquet ini cocok untuk berbagai momen spesial seperti anniversary, ulang tahun, Valentine, lamaran, wisuda, hingga hadiah untuk seseorang yang ingin Anda buat merasa istimewa. Sebuah rangkaian yang memadukan kesan romantis, hangat, dan berkelas dalam satu buket.\r\n\r\nApprox 40 × 20 × 50 cm.', 'Bouquet', 'Gompie,Lilly,Rose', 'Anniversary,Birthday,Graduation,Valentine,Sebulan ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_primary` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `is_primary`, `created_at`) VALUES
(375, 107, 'img/pr/69dcbb390cd12.png', 1, '2026-04-13 09:45:29'),
(376, 107, 'img/pr/69dcbb390d8f2.png', 0, '2026-04-13 09:45:29'),
(377, 107, 'img/pr/69dcbb390e28c.jpeg', 0, '2026-04-13 09:45:29'),
(378, 107, 'img/pr/69dcbb390e5a0.jpeg', 0, '2026-04-13 09:45:29'),
(379, 108, 'img/pr/69dcc26a8b716.png', 1, '2026-04-13 10:16:10'),
(380, 108, 'img/pr/69dcc26a8cda4.png', 0, '2026-04-13 10:16:10'),
(381, 108, 'img/pr/69dcc26a8e289.jpg', 0, '2026-04-13 10:16:10'),
(382, 108, 'img/pr/69dcc26a8e90e.jpg', 0, '2026-04-13 10:16:10'),
(384, 109, 'img/pr/69dcc49c03df0.png', 1, '2026-04-13 10:25:32'),
(385, 109, 'img/pr/69dcc49c050fe.png', 0, '2026-04-13 10:25:32'),
(387, 109, 'img/pr/69dcc49c06a74.jpg', 0, '2026-04-13 10:25:32'),
(388, 109, 'img/pr/69dcc4c57a3ee.jpg', 0, '2026-04-13 10:26:13'),
(391, 109, 'img/pr/69dcc4c57c4eb.jpg', 0, '2026-04-13 10:26:13'),
(393, 110, 'img/pr/69dccd215f3e7.png', 1, '2026-04-13 11:01:53'),
(394, 110, 'img/pr/69dccd2160a91.png', 0, '2026-04-13 11:01:53'),
(395, 110, 'img/pr/69dccd2161c49.png', 0, '2026-04-13 11:01:53'),
(396, 111, 'img/pr/69dcd1f7da4b9.png', 1, '2026-04-13 11:22:31'),
(397, 111, 'img/pr/69dcd1f7db3be.png', 0, '2026-04-13 11:22:31'),
(398, 111, 'img/pr/69dcd1f7dc0b4.png', 0, '2026-04-13 11:22:31'),
(399, 112, 'img/pr/69dcd805ecfde.png', 1, '2026-04-13 11:48:21'),
(400, 112, 'img/pr/69dcd805edc69.png', 0, '2026-04-13 11:48:21'),
(401, 112, 'img/pr/69dcd805ef866.jpg', 0, '2026-04-13 11:48:21'),
(402, 79, 'img/pr/69de22601bbb1.png', 1, '2026-04-14 11:17:52'),
(403, 79, 'img/pr/69de22601c643.png', 0, '2026-04-14 11:17:52'),
(407, 79, 'img/pr/69de22bd3de5c.jpg', 0, '2026-04-14 11:19:25'),
(408, 79, 'img/pr/69de22bd3e828.jpg', 0, '2026-04-14 11:19:25'),
(409, 79, 'img/pr/69de22bd3f145.jpg', 0, '2026-04-14 11:19:25'),
(410, 80, 'img/pr/69de2430aa87c.png', 1, '2026-04-14 11:25:36'),
(411, 80, 'img/pr/69de2430ab258.png', 0, '2026-04-14 11:25:36'),
(412, 80, 'img/pr/69de2430abb2c.jpg', 0, '2026-04-14 11:25:36'),
(413, 80, 'img/pr/69de2430ac51c.jpg', 0, '2026-04-14 11:25:36'),
(414, 80, 'img/pr/69de2430acdcb.jpg', 0, '2026-04-14 11:25:36'),
(415, 81, 'img/pr/69de24def2862.png', 1, '2026-04-14 11:28:30'),
(416, 81, 'img/pr/69de24def3683.png', 0, '2026-04-14 11:28:30'),
(417, 81, 'img/pr/69de24df00077.jpg', 0, '2026-04-14 11:28:31'),
(418, 81, 'img/pr/69de24df00aed.jpg', 0, '2026-04-14 11:28:31'),
(419, 81, 'img/pr/69de24df016de.jpg', 0, '2026-04-14 11:28:31'),
(420, 82, 'img/pr/69de25b87c853.png', 1, '2026-04-14 11:32:08'),
(421, 82, 'img/pr/69de25b87e043.png', 0, '2026-04-14 11:32:08'),
(422, 82, 'img/pr/69de25b87f3fa.jpg', 0, '2026-04-14 11:32:08'),
(423, 82, 'img/pr/69de25b8804c1.jpg', 0, '2026-04-14 11:32:08'),
(424, 82, 'img/pr/69de25b8812e2.jpg', 0, '2026-04-14 11:32:08'),
(425, 84, 'img/pr/69de26459bf07.png', 1, '2026-04-14 11:34:29'),
(426, 84, 'img/pr/69de26459ca50.png', 0, '2026-04-14 11:34:29'),
(427, 84, 'img/pr/69de26459d659.png', 0, '2026-04-14 11:34:29'),
(428, 84, 'img/pr/69de26459df9d.png', 0, '2026-04-14 11:34:29'),
(429, 84, 'img/pr/69de26459e8da.jpg', 0, '2026-04-14 11:34:29'),
(430, 85, 'img/pr/69de28e6e7af8.png', 1, '2026-04-14 11:45:42'),
(431, 85, 'img/pr/69de28e6e9167.png', 0, '2026-04-14 11:45:42'),
(432, 85, 'img/pr/69de28e6ea665.jpg', 0, '2026-04-14 11:45:42'),
(433, 85, 'img/pr/69de28e6eb28c.jpg', 0, '2026-04-14 11:45:42'),
(434, 85, 'img/pr/69de28e6ebc68.jpg', 0, '2026-04-14 11:45:42'),
(435, 86, 'img/pr/69de2bc42d409.png', 1, '2026-04-14 11:57:56'),
(436, 86, 'img/pr/69de2bc42e3fe.png', 0, '2026-04-14 11:57:56'),
(437, 86, 'img/pr/69de2bc42f379.jpg', 0, '2026-04-14 11:57:56'),
(438, 86, 'img/pr/69de2bc4303ad.jpg', 0, '2026-04-14 11:57:56'),
(439, 86, 'img/pr/69de2bc4311cd.jpg', 0, '2026-04-14 11:57:56'),
(440, 87, 'img/pr/69de2d1a77f37.png', 1, '2026-04-14 12:03:38'),
(441, 87, 'img/pr/69de2d1a789fd.png', 0, '2026-04-14 12:03:38'),
(442, 87, 'img/pr/69de2d1a7948e.jpg', 0, '2026-04-14 12:03:38'),
(443, 87, 'img/pr/69de2d1a79e47.jpg', 0, '2026-04-14 12:03:38'),
(444, 87, 'img/pr/69de2d1a7a737.jpg', 0, '2026-04-14 12:03:38'),
(445, 87, 'img/pr/69de2d1a7af34.jpg', 0, '2026-04-14 12:03:38'),
(446, 83, 'img/pr/69df31e98e4f1.png', 1, '2026-04-15 06:36:25'),
(447, 83, 'img/pr/69df31e98f0d7.png', 0, '2026-04-15 06:36:25'),
(448, 83, 'img/pr/69df31e98fed1.jpg', 0, '2026-04-15 06:36:25'),
(449, 83, 'img/pr/69df31e9905bf.jpg', 0, '2026-04-15 06:36:25'),
(450, 88, 'img/pr/69df338f90e48.png', 1, '2026-04-15 06:43:27'),
(451, 88, 'img/pr/69df338f91a53.png', 0, '2026-04-15 06:43:27'),
(452, 88, 'img/pr/69df338f924fe.jpg', 0, '2026-04-15 06:43:27'),
(453, 88, 'img/pr/69df338f92ac6.jpg', 0, '2026-04-15 06:43:27'),
(454, 88, 'img/pr/69df338f9336c.jpg', 0, '2026-04-15 06:43:27'),
(455, 88, 'img/pr/69df338f93ed9.jpg', 0, '2026-04-15 06:43:27'),
(456, 89, 'img/pr/69df3826a5430.png', 1, '2026-04-15 07:03:02'),
(457, 89, 'img/pr/69df3826a6d07.png', 0, '2026-04-15 07:03:02'),
(458, 89, 'img/pr/69df3826a84b0.jpg', 0, '2026-04-15 07:03:02'),
(459, 89, 'img/pr/69df3826a8c1b.jpg', 0, '2026-04-15 07:03:02'),
(467, 89, 'img/pr/69df387eebe0d.jpg', 0, '2026-04-15 07:04:30'),
(468, 89, 'img/pr/69df38a5c2a23.jpg', 0, '2026-04-15 07:05:09'),
(469, 90, 'img/pr/69df3a171de5d.png', 1, '2026-04-15 07:11:19'),
(470, 90, 'img/pr/69df3a171eb01.png', 0, '2026-04-15 07:11:19'),
(471, 90, 'img/pr/69df3a171f698.jpg', 0, '2026-04-15 07:11:19'),
(472, 90, 'img/pr/69df3a171fbbb.jpg', 0, '2026-04-15 07:11:19'),
(474, 90, 'img/pr/69df3a1720c0d.jpg', 0, '2026-04-15 07:11:19'),
(475, 90, 'img/pr/69df3a2bce405.jpg', 0, '2026-04-15 07:11:39'),
(476, 91, 'img/pr/69e205ebd3507.png', 1, '2026-04-17 10:05:31'),
(477, 91, 'img/pr/69e205ebd3fb0.png', 0, '2026-04-17 10:05:31'),
(479, 91, 'img/pr/69e205ebd5852.jpg', 0, '2026-04-17 10:05:31'),
(480, 91, 'img/pr/69e205ebd62eb.jpg', 0, '2026-04-17 10:05:31'),
(481, 91, 'img/pr/69e2463e27e63.jpg', 0, '2026-04-17 14:39:58'),
(487, 93, 'img/pr/69e3589ed3b47.png', 1, '2026-04-18 10:10:38'),
(488, 93, 'img/pr/69e3589ed443c.png', 0, '2026-04-18 10:10:38'),
(490, 93, 'img/pr/69e3589ed55f9.jpg', 0, '2026-04-18 10:10:38'),
(495, 92, 'img/pr/69e35ab41348d.png', 1, '2026-04-18 10:19:32'),
(496, 92, 'img/pr/69e35aeadd937.png', 0, '2026-04-18 10:20:26'),
(498, 92, 'img/pr/69e35aeadf6cd.jpg', 0, '2026-04-18 10:20:26'),
(499, 92, 'img/pr/69e35aeae0827.jpg', 0, '2026-04-18 10:20:26'),
(500, 92, 'img/pr/69e35b1981861.jpg', 0, '2026-04-18 10:21:13'),
(501, 93, 'img/pr/69e35b814a6bf.jpg', 0, '2026-04-18 10:22:57'),
(502, 94, 'img/pr/69e35bc72df4f.png', 1, '2026-04-18 10:24:07'),
(503, 94, 'img/pr/69e35bc72e882.png', 0, '2026-04-18 10:24:07'),
(504, 94, 'img/pr/69e35bc72f0db.jpg', 0, '2026-04-18 10:24:07'),
(505, 113, 'img/pr/69e361f0bc1f5.png', 1, '2026-04-18 10:50:24'),
(506, 113, 'img/pr/69e361f0bce3e.png', 0, '2026-04-18 10:50:24'),
(508, 113, 'img/pr/69e361f0bdf1a.jpg', 0, '2026-04-18 10:50:24'),
(509, 113, 'img/pr/69e361f0be5d8.jpg', 0, '2026-04-18 10:50:24'),
(510, 113, 'img/pr/69e36203cd224.jpg', 0, '2026-04-18 10:50:43'),
(511, 114, 'img/pr/69e364b8cf539.png', 1, '2026-04-18 11:02:16'),
(512, 114, 'img/pr/69e364b8d0a67.png', 0, '2026-04-18 11:02:16'),
(513, 114, 'img/pr/69e364b8d1aa4.jpg', 0, '2026-04-18 11:02:16'),
(514, 114, 'img/pr/69e364b8d1f6c.jpg', 0, '2026-04-18 11:02:16'),
(515, 115, 'img/pr/69e38c0385a6a.png', 1, '2026-04-18 13:49:55'),
(516, 115, 'img/pr/69e38c0386655.png', 0, '2026-04-18 13:49:55'),
(517, 115, 'img/pr/69e38c0387046.jpg', 0, '2026-04-18 13:49:55'),
(518, 115, 'img/pr/69e38c0387374.jpg', 0, '2026-04-18 13:49:55'),
(519, 115, 'img/pr/69e38c03877b6.jpg', 0, '2026-04-18 13:49:55'),
(520, 116, 'img/pr/69e38e7e5c85b.png', 1, '2026-04-18 14:00:30'),
(521, 116, 'img/pr/69e38e7e5d4d5.png', 0, '2026-04-18 14:00:30'),
(522, 116, 'img/pr/69e38e7e5deff.jpg', 0, '2026-04-18 14:00:30'),
(523, 116, 'img/pr/69e38e7e5e227.jpg', 0, '2026-04-18 14:00:30'),
(524, 117, 'img/pr/69ea0fe7db23e.png', 1, '2026-04-23 12:26:15'),
(525, 117, 'img/pr/69ea0fe7dbff3.png', 0, '2026-04-23 12:26:15'),
(526, 117, 'img/pr/69ea0fe7dcafa.jpg', 0, '2026-04-23 12:26:15'),
(527, 117, 'img/pr/69ea0fe7dce87.jpg', 0, '2026-04-23 12:26:15'),
(528, 117, 'img/pr/69ea0fe7dd333.jpg', 0, '2026-04-23 12:26:15'),
(529, 118, 'img/pr/69ec37d17972f.png', 1, '2026-04-25 03:41:05'),
(530, 118, 'img/pr/69ec37d17a4af.png', 0, '2026-04-25 03:41:05'),
(533, 118, 'img/pr/69ec38d88f88f.jpg', 0, '2026-04-25 03:45:28'),
(534, 118, 'img/pr/69ec38d88fd73.jpg', 0, '2026-04-25 03:45:28'),
(535, 119, 'img/pr/69ec3a799253f.png', 1, '2026-04-25 03:52:25'),
(536, 119, 'img/pr/69ec3a7992f04.png', 0, '2026-04-25 03:52:25'),
(538, 119, 'img/pr/69ec3a7993b53.jpg', 0, '2026-04-25 03:52:25'),
(539, 119, 'img/pr/69ec3a9103433.jpg', 0, '2026-04-25 03:52:49'),
(540, 120, 'img/pr/69ec3c547dccb.png', 1, '2026-04-25 04:00:20'),
(541, 120, 'img/pr/69ec3c547ef4b.png', 0, '2026-04-25 04:00:20'),
(542, 120, 'img/pr/69ec3c54800da.jpg', 0, '2026-04-25 04:00:20'),
(543, 120, 'img/pr/69ec3c5480580.jpg', 0, '2026-04-25 04:00:20'),
(544, 121, 'img/pr/69ec3d3dc94ec.png', 1, '2026-04-25 04:04:13'),
(545, 121, 'img/pr/69ec3d3dc9f2e.png', 0, '2026-04-25 04:04:13'),
(546, 121, 'img/pr/69ec3d3dca79c.jpg', 0, '2026-04-25 04:04:13'),
(547, 121, 'img/pr/69ec3d3dcabb6.jpg', 0, '2026-04-25 04:04:13'),
(548, 122, 'img/pr/69ec3dc399dea.png', 1, '2026-04-25 04:06:27'),
(549, 122, 'img/pr/69ec3dc39a933.png', 0, '2026-04-25 04:06:27'),
(550, 122, 'img/pr/69ec3dc39b380.jpeg', 0, '2026-04-25 04:06:27'),
(551, 122, 'img/pr/69ec3dc39b7a0.jpeg', 0, '2026-04-25 04:06:27'),
(552, 123, 'img/pr/69ec5272e57be.png', 1, '2026-04-25 05:34:42'),
(553, 123, 'img/pr/69ec5272e6419.png', 0, '2026-04-25 05:34:42'),
(556, 123, 'img/pr/69ec5272e7e6d.jpg', 0, '2026-04-25 05:34:42'),
(557, 123, 'img/pr/69ec528ba418e.jpg', 0, '2026-04-25 05:35:07'),
(558, 123, 'img/pr/69ec528ba47a0.jpg', 0, '2026-04-25 05:35:07'),
(559, 124, 'img/pr/69ec5bd0d2732.png', 1, '2026-04-25 06:14:40'),
(560, 124, 'img/pr/69ec5bd0d32b2.png', 0, '2026-04-25 06:14:40'),
(564, 125, 'img/pr/69ec857fe743c.png', 1, '2026-04-25 09:12:31'),
(565, 125, 'img/pr/69ec857fe7f2e.png', 0, '2026-04-25 09:12:31'),
(566, 125, 'img/pr/69ec8599b45b0.jpg', 0, '2026-04-25 09:12:57'),
(567, 125, 'img/pr/69ec8599b4ad8.jpg', 0, '2026-04-25 09:12:57'),
(568, 125, 'img/pr/69ec8599b4e9d.jpg', 0, '2026-04-25 09:12:57'),
(569, 126, 'img/pr/69ec86254d3e2.png', 1, '2026-04-25 09:15:17'),
(570, 126, 'img/pr/69ec86254e6e6.png', 0, '2026-04-25 09:15:17'),
(571, 126, 'img/pr/69ec86254f74a.jpg', 0, '2026-04-25 09:15:17'),
(572, 126, 'img/pr/69ec86254fa47.jpg', 0, '2026-04-25 09:15:17'),
(573, 127, 'img/pr/69f70c40752de.png', 1, '2026-05-03 08:50:08'),
(574, 127, 'img/pr/69f70c4075e75.png', 0, '2026-05-03 08:50:08'),
(575, 127, 'img/pr/69f70c4076923.jpg', 0, '2026-05-03 08:50:08'),
(576, 127, 'img/pr/69f70c4076c12.jpg', 0, '2026-05-03 08:50:08'),
(578, 128, 'img/pr/69f7116699b3f.png', 1, '2026-05-03 09:12:06'),
(579, 128, 'img/pr/69f711669a7f1.png', 0, '2026-05-03 09:12:06'),
(580, 128, 'img/pr/69f711669b21f.jpg', 0, '2026-05-03 09:12:06'),
(581, 128, 'img/pr/69f711744093b.jpg', 0, '2026-05-03 09:12:20'),
(582, 129, 'img/pr/69f71ace9ab73.png', 1, '2026-05-03 09:52:14'),
(583, 129, 'img/pr/69f71ace9b70a.png', 0, '2026-05-03 09:52:14'),
(584, 129, 'img/pr/69f71ace9c0b7.jpg', 0, '2026-05-03 09:52:14'),
(585, 129, 'img/pr/69f71ace9c761.jpg', 0, '2026-05-03 09:52:14'),
(586, 130, 'img/pr/6a01de627e2d9.png', 1, '2026-05-11 13:49:22'),
(587, 130, 'img/pr/6a01de627ee9e.png', 0, '2026-05-11 13:49:22'),
(588, 130, 'img/pr/6a01de627f9a8.jpg', 0, '2026-05-11 13:49:22'),
(589, 130, 'img/pr/6a01de627fd87.jpg', 0, '2026-05-11 13:49:22'),
(590, 130, 'img/pr/6a01de62801b0.jpg', 0, '2026-05-11 13:49:22'),
(591, 131, 'img/pr/6a01e2962763d.png', 1, '2026-05-11 14:07:18'),
(592, 131, 'img/pr/6a01e296283c6.png', 0, '2026-05-11 14:07:18'),
(593, 131, 'img/pr/6a01e29629095.jpg', 0, '2026-05-11 14:07:18'),
(594, 131, 'img/pr/6a01e29629705.jpg', 0, '2026-05-11 14:07:18'),
(595, 131, 'img/pr/6a01e29629b6a.jpg', 0, '2026-05-11 14:07:18'),
(596, 132, 'img/pr/6a01e385c0e31.png', 1, '2026-05-11 14:11:17'),
(597, 132, 'img/pr/6a01e385c1cbd.png', 0, '2026-05-11 14:11:17'),
(598, 132, 'img/pr/6a01e385c29ce.jpg', 0, '2026-05-11 14:11:17'),
(599, 132, 'img/pr/6a01e385c35c5.jpg', 0, '2026-05-11 14:11:17'),
(600, 132, 'img/pr/6a01e385c3f15.jpg', 0, '2026-05-11 14:11:17'),
(601, 133, 'img/pr/6a01e4d125706.png', 1, '2026-05-11 14:16:49'),
(602, 133, 'img/pr/6a01e4d1270b5.png', 0, '2026-05-11 14:16:49'),
(603, 133, 'img/pr/6a01e4d128424.jpg', 0, '2026-05-11 14:16:49'),
(604, 133, 'img/pr/6a01e4d128a40.jpg', 0, '2026-05-11 14:16:49'),
(605, 133, 'img/pr/6a01e4d128e3a.jpg', 0, '2026-05-11 14:16:49'),
(606, 134, 'img/pr/6a02deffdd2b1.png', 1, '2026-05-12 08:04:15'),
(607, 134, 'img/pr/6a02deffde0c6.png', 0, '2026-05-12 08:04:15'),
(608, 134, 'img/pr/6a02deffdee00.png', 0, '2026-05-12 08:04:15'),
(609, 134, 'img/pr/6a02deffe0014.jpg', 0, '2026-05-12 08:04:15'),
(610, 135, 'img/pr/6a047994a7960.png', 1, '2026-05-13 13:16:04'),
(611, 135, 'img/pr/6a047994a924d.png', 0, '2026-05-13 13:16:04'),
(612, 135, 'img/pr/6a047994aabbb.png', 0, '2026-05-13 13:16:04'),
(615, 136, 'img/pr/6a047a618e4cd.png', 1, '2026-05-13 13:19:29'),
(616, 136, 'img/pr/6a047aac07f18.png', 0, '2026-05-13 13:20:44'),
(617, 136, 'img/pr/6a047aac08a95.png', 0, '2026-05-13 13:20:44'),
(618, 137, 'img/pr/6a0481d054680.png', 1, '2026-05-13 13:51:12'),
(619, 137, 'img/pr/6a0481d05556a.png', 0, '2026-05-13 13:51:12'),
(620, 137, 'img/pr/6a0481d056272.jpg', 0, '2026-05-13 13:51:12'),
(621, 137, 'img/pr/6a0481d056715.jpg', 0, '2026-05-13 13:51:12'),
(622, 138, 'img/pr/6a04832d2fec9.png', 1, '2026-05-13 13:57:01'),
(623, 138, 'img/pr/6a04832d30bd3.png', 0, '2026-05-13 13:57:01'),
(624, 138, 'img/pr/6a04832d31786.jpg', 0, '2026-05-13 13:57:01'),
(625, 138, 'img/pr/6a04832d31ddd.jpg', 0, '2026-05-13 13:57:01'),
(626, 139, 'img/pr/6a0d3d0b44485.png', 1, '2026-05-20 04:48:11'),
(627, 139, 'img/pr/6a0d3d0b4508d.png', 0, '2026-05-20 04:48:11'),
(628, 139, 'img/pr/6a0d3d0b45ab2.jpg', 0, '2026-05-20 04:48:11'),
(631, 140, 'img/pr/6a0d42568ce5a.png', 1, '2026-05-20 05:10:46'),
(632, 140, 'img/pr/6a0d42568db56.png', 0, '2026-05-20 05:10:46'),
(634, 140, 'img/pr/6a0d42c0ecf81.jpg', 0, '2026-05-20 05:12:32'),
(635, 140, 'img/pr/6a0d42c0ed301.jpg', 0, '2026-05-20 05:12:32'),
(636, 140, 'img/pr/6a0d42c0ed583.jpg', 0, '2026-05-20 05:12:32'),
(637, 141, 'img/pr/6a0d4e088cf8e.png', 1, '2026-05-20 06:00:40'),
(638, 141, 'img/pr/6a0d4e088db6b.png', 0, '2026-05-20 06:00:40'),
(639, 141, 'img/pr/6a0d4e088e565.jpg', 0, '2026-05-20 06:00:40'),
(641, 142, 'img/pr/6a0d4f4d19051.png', 1, '2026-05-20 06:06:05'),
(642, 142, 'img/pr/6a0d4f4d19b50.png', 0, '2026-05-20 06:06:05'),
(643, 142, 'img/pr/6a0d4f4d1a5bf.jpg', 0, '2026-05-20 06:06:05'),
(644, 142, 'img/pr/6a0d4f57dec25.jpg', 0, '2026-05-20 06:06:15'),
(645, 143, 'img/pr/6a0d5049633b3.png', 1, '2026-05-20 06:10:17'),
(646, 143, 'img/pr/6a0d5049648ed.png', 0, '2026-05-20 06:10:17'),
(647, 143, 'img/pr/6a0d504965cf3.jpg', 0, '2026-05-20 06:10:17'),
(648, 143, 'img/pr/6a0d504966185.jpg', 0, '2026-05-20 06:10:17'),
(649, 144, 'img/pr/6a0ebfcb02d39.png', 1, '2026-05-21 08:18:19'),
(650, 144, 'img/pr/6a0ebfcb03a25.png', 0, '2026-05-21 08:18:19'),
(651, 144, 'img/pr/6a0ebfcb04521.jpg', 0, '2026-05-21 08:18:19'),
(652, 144, 'img/pr/6a0ebfcb04947.jpg', 0, '2026-05-21 08:18:19'),
(653, 144, 'img/pr/6a0ebfcb04e4a.jpg', 0, '2026-05-21 08:18:19'),
(654, 145, 'img/pr/6a0ec36675f51.png', 1, '2026-05-21 08:33:42'),
(655, 145, 'img/pr/6a0ec36676ef3.png', 0, '2026-05-21 08:33:42'),
(656, 145, 'img/pr/6a0ec36677bd1.jpg', 0, '2026-05-21 08:33:42'),
(660, 146, 'img/pr/6a0ec4de970ac.png', 1, '2026-05-21 08:39:58'),
(661, 146, 'img/pr/6a0ec4de98031.png', 0, '2026-05-21 08:39:58'),
(662, 146, 'img/pr/6a0ec4efc74aa.jpg', 0, '2026-05-21 08:40:15'),
(663, 146, 'img/pr/6a0ec4efc7ad0.jpg', 0, '2026-05-21 08:40:15'),
(664, 146, 'img/pr/6a0ec4efc819a.jpg', 0, '2026-05-21 08:40:15'),
(665, 147, 'img/pr/6a0ec607c8bb5.png', 1, '2026-05-21 08:44:55'),
(666, 147, 'img/pr/6a0ec607c9b03.png', 0, '2026-05-21 08:44:55'),
(667, 147, 'img/pr/6a0ec607ca71b.jpg', 0, '2026-05-21 08:44:55'),
(668, 147, 'img/pr/6a0ec607cab1f.jpg', 0, '2026-05-21 08:44:55'),
(669, 147, 'img/pr/6a0ec607caf49.jpg', 0, '2026-05-21 08:44:55'),
(670, 148, 'img/pr/6a140f799cb6f.png', 1, '2026-05-25 08:59:37'),
(671, 148, 'img/pr/6a140f799d69d.png', 0, '2026-05-25 08:59:37'),
(672, 148, 'img/pr/6a140f799e032.jpg', 0, '2026-05-25 08:59:37'),
(673, 148, 'img/pr/6a140f799e2cb.jpg', 0, '2026-05-25 08:59:37'),
(674, 148, 'img/pr/6a140f799e563.jpg', 0, '2026-05-25 08:59:37'),
(675, 149, 'img/pr/6a141082baeeb.png', 1, '2026-05-25 09:04:02'),
(676, 149, 'img/pr/6a141082bc26f.png', 0, '2026-05-25 09:04:02'),
(677, 149, 'img/pr/6a141082bd646.jpg', 0, '2026-05-25 09:04:02'),
(678, 149, 'img/pr/6a141082be5e5.jpg', 0, '2026-05-25 09:04:02'),
(681, 150, 'img/pr/6a1411e0f1152.png', 1, '2026-05-25 09:09:52'),
(682, 150, 'img/pr/6a1411e0f2367.png', 0, '2026-05-25 09:09:52'),
(683, 150, 'img/pr/6a141252ce092.jpg', 0, '2026-05-25 09:11:46'),
(684, 150, 'img/pr/6a141252cf167.jpg', 0, '2026-05-25 09:11:46'),
(685, 151, 'img/pr/6a268b3166b10.png', 1, '2026-06-08 09:28:17'),
(686, 151, 'img/pr/6a268b31686d7.png', 0, '2026-06-08 09:28:17'),
(687, 151, 'img/pr/6a268b31693c3.jpg', 0, '2026-06-08 09:28:17'),
(688, 151, 'img/pr/6a268b316991f.jpg', 0, '2026-06-08 09:28:17'),
(689, 152, 'img/pr/6a268cdcae21c.png', 1, '2026-06-08 09:35:24'),
(690, 152, 'img/pr/6a268cdcaee9f.png', 0, '2026-06-08 09:35:24'),
(691, 152, 'img/pr/6a268cdcafa04.jpg', 0, '2026-06-08 09:35:24'),
(692, 152, 'img/pr/6a268cdcafe3c.jpg', 0, '2026-06-08 09:35:24'),
(693, 153, 'img/pr/6a27cd91dccfe.png', 1, '2026-06-09 08:23:45'),
(694, 153, 'img/pr/6a27cd91de3c0.png', 0, '2026-06-09 08:23:45'),
(695, 153, 'img/pr/6a27cd91df904.jpg', 0, '2026-06-09 08:23:45'),
(696, 153, 'img/pr/6a27cd91e01b0.jpg', 0, '2026-06-09 08:23:45'),
(697, 153, 'img/pr/6a27cd91e0740.jpg', 0, '2026-06-09 08:23:45'),
(698, 154, 'img/pr/6a27cf20b1435.png', 1, '2026-06-09 08:30:24'),
(699, 154, 'img/pr/6a27cf20b29de.png', 0, '2026-06-09 08:30:24'),
(700, 154, 'img/pr/6a27cf20b3e59.JPG', 0, '2026-06-09 08:30:24'),
(701, 154, 'img/pr/6a27cf20b5501.JPG', 0, '2026-06-09 08:30:24'),
(702, 155, 'img/pr/6a27d1248943f.png', 1, '2026-06-09 08:39:00'),
(703, 155, 'img/pr/6a27d1248b341.png', 0, '2026-06-09 08:39:00'),
(704, 155, 'img/pr/6a27d1248c2fc.jpg', 0, '2026-06-09 08:39:00'),
(705, 155, 'img/pr/6a27d1248cb43.jpg', 0, '2026-06-09 08:39:00'),
(706, 156, 'img/pr/6a27d1d4216aa.png', 1, '2026-06-09 08:41:56'),
(707, 156, 'img/pr/6a27d1d42237c.png', 0, '2026-06-09 08:41:56'),
(708, 156, 'img/pr/6a27d1d422f08.jpg', 0, '2026-06-09 08:41:56'),
(709, 156, 'img/pr/6a27d1d4236fa.jpg', 0, '2026-06-09 08:41:56'),
(710, 157, 'img/pr/6a4b55e079d7c.png', 1, '2026-07-06 07:14:40'),
(711, 157, 'img/pr/6a4b55e07b18b.png', 0, '2026-07-06 07:14:40'),
(712, 157, 'img/pr/6a4b55e07bac4.jpg', 0, '2026-07-06 07:14:40'),
(713, 157, 'img/pr/6a4b55e07be94.jpg', 0, '2026-07-06 07:14:40'),
(715, 158, 'img/pr/6a4b597ceebcb.png', 1, '2026-07-06 07:30:04'),
(716, 158, 'img/pr/6a4b597cef593.png', 0, '2026-07-06 07:30:04'),
(717, 158, 'img/pr/6a4b597cefe4a.jpg', 0, '2026-07-06 07:30:04'),
(718, 158, 'img/pr/6a4b597cf01ae.jpg', 0, '2026-07-06 07:30:04'),
(719, 158, 'img/pr/6a4b5af6e6a09.jpg', 0, '2026-07-06 07:36:22'),
(720, 159, 'img/pr/6a4de265c4810.png', 1, '2026-07-08 05:38:45'),
(721, 159, 'img/pr/6a4de265c5e5a.png', 0, '2026-07-08 05:38:45'),
(722, 159, 'img/pr/6a4de265c703b.jpg', 0, '2026-07-08 05:38:45'),
(723, 159, 'img/pr/6a4de265c73d7.jpg', 0, '2026-07-08 05:38:45'),
(724, 159, 'img/pr/6a4de265c76ef.jpg', 0, '2026-07-08 05:38:45'),
(725, 160, 'img/pr/6a4de3ee2f387.png', 1, '2026-07-08 05:45:18'),
(726, 160, 'img/pr/6a4de3ee30ba2.png', 0, '2026-07-08 05:45:18'),
(727, 160, 'img/pr/6a4de3ee31b90.jpg', 0, '2026-07-08 05:45:18'),
(728, 160, 'img/pr/6a4de3ee31f7c.jpg', 0, '2026-07-08 05:45:18'),
(731, 161, 'img/pr/6a4e1b06d3b5a.png', 1, '2026-07-08 09:40:22'),
(732, 161, 'img/pr/6a4e1b06d47ce.png', 0, '2026-07-08 09:40:22'),
(733, 161, 'img/pr/6a4e1b1bd890d.jpg', 0, '2026-07-08 09:40:43'),
(734, 161, 'img/pr/6a4e1b1bd91d1.jpg', 0, '2026-07-08 09:40:43'),
(735, 162, 'img/pr/6a4e1c6781f2d.png', 1, '2026-07-08 09:46:15'),
(736, 162, 'img/pr/6a4e1c6782b68.png', 0, '2026-07-08 09:46:15'),
(737, 162, 'img/pr/6a4e1c6783751.jpg', 0, '2026-07-08 09:46:15'),
(738, 162, 'img/pr/6a4e1c6783b18.jpg', 0, '2026-07-08 09:46:15'),
(739, 162, 'img/pr/6a4e1c6783efd.jpg', 0, '2026-07-08 09:46:15'),
(740, 162, 'img/pr/6a4e1c6784243.jpg', 0, '2026-07-08 09:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id_transaction` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `total_items` int(11) NOT NULL,
  `subtotal` bigint(20) NOT NULL,
  `status` enum('belum diproses','diproses','selesai') DEFAULT 'belum diproses',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `discount` bigint(20) NOT NULL DEFAULT '0',
  `campaign` varchar(100) DEFAULT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `campaign_name` varchar(255) DEFAULT NULL,
  `campaign_code` varchar(100) DEFAULT NULL,
  `discount_percent` decimal(5,2) DEFAULT '0.00',
  `discount_amount` bigint(20) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id_transaction`, `user_id`, `total_items`, `subtotal`, `status`, `created_at`, `discount`, `campaign`, `campaign_id`, `campaign_name`, `campaign_code`, `discount_percent`, `discount_amount`) VALUES
(7, 'IL014', 1, 100000, 'selesai', '2026-01-24 03:11:47', 0, NULL, NULL, NULL, NULL, '0.00', 0),
(8, 'IL016', 1, 320000, 'selesai', '2026-02-13 01:38:32', 0, NULL, NULL, NULL, NULL, '0.00', 0),
(9, 'IL017', 1, 145000, 'belum diproses', '2026-06-23 03:54:19', 0, NULL, NULL, NULL, NULL, '0.00', 0),
(10, 'IL017', 1, 300000, 'belum diproses', '2026-06-23 03:57:36', 0, NULL, NULL, NULL, NULL, '0.00', 0),
(11, 'IL017', 1, 300000, 'belum diproses', '2026-06-23 04:01:55', 0, NULL, NULL, NULL, NULL, '0.00', 0),
(12, 'IL017', 1, 300000, 'belum diproses', '2026-06-23 04:06:27', 0, NULL, NULL, NULL, NULL, '0.00', 0),
(13, 'IL017', 1, 300000, 'belum diproses', '2026-06-23 04:07:28', 0, NULL, NULL, NULL, NULL, '0.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id_item` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id_item`, `transaction_id`, `product_id`, `qty`, `price`) VALUES
(7, 9, 156, 1, 145000),
(8, 10, 150, 1, 300000),
(9, 11, 150, 1, 300000),
(10, 12, 150, 1, 300000),
(11, 13, 150, 1, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `whatsapp`, `password`, `date_of_birth`, `created_at`, `address`) VALUES
('IL001', 'baros', 'andrianbaros46@gmail.com', '', '$2y$10$uZozSrM25US9Iz8NpJvOYuReuBDIhj/a/pJgra5RGWsVW5nb7YDYi', '2003-01-08', '2025-09-07 19:19:39', 'KBB'),
('IL002', 'Ryuuou', 'a@a.a', '', '$2y$10$TPMrRNj.m4MamtAG6m/U2.03eqAJNg2gvCKJPTpk7wjS202/noRGq', '2025-09-08', '2025-09-08 04:23:10', 'a'),
('IL003', 'chef', 'aji.10121095@mahasiswa.unikom.ac.id', '', '$2y$10$DajmbiKrGmVccFzNVoLm1eMmDfN/KLe5qVJe8JnC9nakLGRbTvm5q', '2025-09-08', '2025-09-08 16:30:41', ''),
('IL005', 'ilmisgarden', 'ilmisgarden@gmail.com', '', '$2y$10$jnLdy4rR1k1LxvFQJDFq2ezSDZ16Kn3uEVhpozUhBmvXyi6f2rO5y', '2020-01-01', '2025-10-09 11:15:48', ''),
('IL006', 'baros', 'anjaymabar@gmail.com', '', '$2y$10$.tErAprp5WMblFNGInjb4OzxK5PQ6LTzL95KAEf2JUB7lgz4Gli/a', '2025-10-28', '2025-10-30 03:03:45', ''),
('IL007', 'nurulilmiss', 'nurulilmisuhada@gmail.com', '', '$2y$10$FOnxBm3/xYbzqbwUujbRfe9GCNCH6UbUt2sUIQST2xlGY/giia8Uq', '1995-12-15', '2025-11-27 15:45:23', 'Jl. Raya Golf Dago No.4'),
('IL008', 'levinakun05@gmail.com', 'levinakun05@gmail.com', '', '$2y$10$0iTX7.tuB3CCVmUyhvTZFuXFiSwuCIumQ1YY.N6dWjpemVfLB4Cy.', '1993-06-16', '2025-11-28 06:35:19', 'Jalan raya nanjung'),
('IL009', 'baros10', 'baros10@gmail.com', '0888888888', '$2y$10$asKNip80gip8Q32XRYrqROEYvtmol0y4.PfRIxUm4BLGnhEa1KjbO', '1999-02-24', '2025-12-28 03:48:35', 'baros'),
('IL010', 'faunahs', 'shafiyanurul@gmail.com', '085353336327', '$2y$10$34qH43vhRlKqNNdZvxHDLusnri/jKWVkYgOpIFZr4mxkvPbAPR5kq', '1991-12-20', '2026-01-02 08:52:09', 'jalan salendro timur 2 no 3 bandung 40275'),
('IL011', 'danuu', 'didaadanuwijaya@gmail.com', '089507363235', '$2y$10$w4BkA2.nAHBIboC7xcOcSuiOEO73LJi0SnXMd.VDP44efoEImLz4.', '2002-08-05', '2026-01-05 04:04:03', 'permata cimahi\r\n'),
('IL012', 'Bibah', 'habibahnf15@gmail.com', '0895343770222', '$2y$10$.ernNy7cxdg8uulAR/FLX.ew8KkVvZjaUmTiG3oyS1KRKKUOmzBMi', '2026-01-05', '2026-01-05 05:05:28', 'Jl dago atas'),
('IL013', 'N4', 'ramadany058@gmail.com', '082185114173', '$2y$10$H5nbYj/oKFjPptJOw/9.x.BySWPT2Ha36.Pt.z2wT2yHaW59AAF8S', '1998-01-18', '2026-01-20 04:58:11', 'Jl. Raya Golf Dago No.4'),
('IL014', 'nashwannaf', 'nnaafilaa@gmail.com', '085720359093', '$2y$10$vzSNimQ6jHYRnUAA5LYGVe/y0fTUavmz278uJAOv.Mw1Bg18MjqKu', '2006-12-21', '2026-01-24 03:10:47', 'tubagus ismail III, dago bandung'),
('IL015', '1', 'asadas@dasda.j', '08678678757', '$2y$10$Cod4Aurwb6mr0/hkzdngYOcG2loPsbROeRUEsFJbpJEojbbh1biHO', '1998-06-16', '2026-01-30 12:45:52', '1'),
('IL016', 'mutiaraa_', 'mutiailmiana@gmail.com', '085717197962', '$2y$10$gWekOGrBotqtS7ReCMwYIeAcyXssUclNn013SvCYv9TJJkYIZ2IRe', '2003-03-23', '2026-02-13 01:32:41', 'Bekasi Timur Regensi blok H7/3'),
('IL017', 'Salsabila Raihan', 'salsabilaraihan.sr@gmail.com', '0882000447475', '$2y$10$6RA0fEDKqjCHNkNciL.ZE.38zEE/Dk.d7z9PRGjEIHRVthwiwO8j.', '2007-01-10', '2026-06-23 03:52:49', 'JL. Kaum Timur, no.78 Dayeuhkolot');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `campaign_code` (`campaign_code`);

--
-- Indexes for table `campaign_visits`
--
ALTER TABLE `campaign_visits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD UNIQUE KEY `unique_cart` (`user_id`,`product_id`),
  ADD KEY `fk_cart_product` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_images` (`product_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `campaign_visits`
--
ALTER TABLE `campaign_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=741;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_product_images` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id_transaction`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
