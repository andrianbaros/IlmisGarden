-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.5.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ilmisgarden_db
CREATE DATABASE IF NOT EXISTS `ilmisgarden_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `ilmisgarden_db`;

-- Dumping structure for table ilmisgarden_db.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden_db.admin: ~1 rows (approximately)
INSERT INTO `admin` (`id_admin`, `username`, `email`, `password`, `created_at`) VALUES
	(3, 'admin', 'admin@ilmis.com', '$2y$10$TDf8Vvm6yMsEHwXBLWb3Eux8CErm1uvqhLB.7oo5I6relknebFd76', '2025-09-10 04:02:30');

-- Dumping structure for table ilmisgarden_db.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id_cart` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_cart`),
  UNIQUE KEY `unique_cart` (`user_id`,`product_id`),
  KEY `fk_cart_product` (`product_id`),
  CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden_db.cart: ~0 rows (approximately)
INSERT INTO `cart` (`id_cart`, `user_id`, `product_id`, `qty`, `created_at`, `updated_at`) VALUES
	(25, 'IL010', 54, 1, '2025-12-28 05:25:52', '2025-12-28 05:25:52');

-- Dumping structure for table ilmisgarden_db.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden_db.products: ~35 rows (approximately)
INSERT INTO `products` (`id`, `name`, `price`, `description`, `type`) VALUES
	(17, 'Red Noir', 283000, 'Red Noir adalah rangkaian mawar merah tua nan memukau yang memancarkan pesona misterius dan elegan. Warna merah pekatnya melambangkan gairah, kekuatan, dan cinta yang mendalam — sempurna untuk mengungkapkan perasaan intens dengan sentuhan kemewahan dan keanggunan klasik.\r\n\r\nBouquet ini terdiri dari 9 tangkai mawar merah dan baby breath.\r\n\r\nTinggi bouquet ± 45–50 cm.', 'flower'),
	(18, 'Serene Bloom Bouquet', 530000, 'Serene Bloom Bouquet menghadirkan keindahan yang menenangkan lewat perpaduan bunga lembut bernuansa pastel. Setiap kelopak dipilih dengan cermat untuk menciptakan harmoni dan kedamaian dalam satu rangkaian. Sempurna untuk mengungkapkan ketulusan, ucapan terima kasih, atau harapan penuh ketenangan.\r\n\r\nRangkaian ini mengkombinasikan bunga premium seperti lily putih yang mekar anggun, carnation, mawar, chrysanthemum hijau, serta eucalyptus sebagai filler.\r\n\r\nTinggi bouquet ± 50 – 60 cm.', 'flower'),
	(19, 'Sunshine Bliss Bouquet', 150000, 'Sunshine Bliss Bouquet memancarkan keceriaan dan kehangatan layaknya sinar mentari pagi. Rangkaian bunga berwarna kuning cerah dan putih lembut ini melambangkan optimisme, kebahagiaan, dan energi positif — pilihan sempurna untuk mencerahkan hari seseorang atau merayakan momen penuh sukacita.\r\n\r\nBouquet ini disusun dari bunga matahari, mawar, dan daun sebagai filler nya.\r\n\r\nTinggi bouquet ± 30 – 40 cm.', 'flower'),
	(20, 'Rosé Amour Bouquet', 610000, 'Rosé Amour Bouquet adalah perpaduan mawar merah muda lembut yang melambangkan kasih sayang, keanggunan, dan ketulusan cinta. Setiap tangkai dipilih dengan hati-hati untuk menciptakan rangkaian yang anggun dan romantis — sempurna untuk mengungkapkan perasaan pada momen istimewa seperti ulang tahun, hari kasih sayang, atau perayaan cinta.\r\n\r\nBouquet ini terdiri dari 20 tangkai mawar merah, dan 20 tangkai mawar putih, dan filler.\r\n\r\nTinggi bouquet ± 50 – 70 cm.', 'flower'),
	(21, 'Single Rose Bouquet', 50000, 'Bouquet single rose ini tampil anggun melalui kesederhanaannya. Menggunakan satu batang mawar merah sebagai bunga utama, bouquet ini melambangkan cinta yang tulus, ketegasan perasaan, dan keindahan yang tidak berlebihan.\r\n\r\nFiller bisa berupa daun, baby breath, caspea, dll.\r\n\r\nTinggi bouquet ± 25 cm.', 'flower'),
	(22, 'Petite Rose Bouquet', 85000, 'Rangkaian mawar ini menghadirkan kesan manis, elegan, dan penuh ketulusan. Tampil dengan ukuran compact namun tetap berkesan mewah, bouquet ini menggunakan mawar fresh berkualitas yang mekar sebagai bunga utama.\r\n\r\nBouquet ini terdiri dari 3 tangkai mawar, dan filler.\r\n\r\nTinggi bouquet ± 30.', 'flower'),
	(23, 'Small Rose Bouquet', 155000, 'Small Rose Bouquet adalah rangkaian yang terdiri dari 5 tangkai bunga mawar fresh yang mekar cantik, bouquet ini cocok untuk ulang tahun, aniversarry, valentine, dan ungkapan terima kasih atau apresiasi lainnya.\r\n\r\nTersedia juga mawar warna pink, putih, peach.\r\n\r\nTinggi bouquet ± 30 – 35 cm.', 'flower'),
	(24, 'Single Hydrangea Bouquet', 80000, 'Single Hydrangea Bouquet ini adalah rangkaian bunga minimalis tapi tetap terlihat mewah. Menggunakan satu tangkai hydrangea fresh sebagai bunga utama, hydrangea dikenal sebagai simbol ketulusan, ucapan terima kasih, dan hubungan yang tulus, menjadikannya pilihan ideal untuk berbagai momen bermakna.\r\n\r\nTinggi bouquet ± 30 cm.', 'flower'),
	(25, 'Medium Blushing Petals Bouquet', 325000, 'Blushing Petals Bouquet ini dibuat dengan perpaduan warna pink pastel yang lembut dan penuh keceriaan, menghadirkan tampilan romantis sekaligus fresh. Cocok untuk menyampaikan pesan yang tulus seperti ulang tahun, aniversarry, graduation, dll.\r\n\r\nDisusun dengan kombinasi mawar pink, gerbera, chrysanthemum, dan carnation yang menambah tekstur manis pada rangkaian.\r\n\r\nTinggi bouquet ± 45 – 50 cm.', 'flower'),
	(26, 'Thumbelina Bouquet', 320000, 'Thumbelina Bouquet dikenal sebagai rangkaian bunga yang memancarkan keceriaan, kelembutan, dan energi positif melalui kombinasi warnanya yang hangat dan harmonis. Buket ini menggunakan perpaduan bunga berwarna peach, pink, merah, kuning, krem, dan sentuhan ungu, menciptakan tampilan yang feminine, youthful, dan lively.\r\n\r\nTinggi bouquet ± 45–55 cm.\r\n\r\nHubungi admin untuk custom warna yang diinginkan.', 'flower'),
	(27, 'Large Blushing Petals Bouquet', 500000, 'Blushing Petals Bouquet ini dibuat dengan perpaduan warna pink pastel yang lembut dan penuh keceriaan, menghadirkan tampilan romantis sekaligus fresh. Cocok untuk menyampaikan pesan yang tulus seperti ulang tahun, aniversarry, graduation, dll.\r\n\r\nDisusun dengan kombinasi mawar pink, gerbera, gompie, dan carnation yang menambah tekstur manis pada rangkaian.\r\n\r\nTinggi bouquet ± 50 – 60 cm.', 'flower'),
	(28, 'Summer Breeze Bouquet', 427000, 'Perpaduan cerah sunflower dan sentuhan pastel pink yang menghadirkan energi positif dan kehangatan di bouquet ini. Melambangkan kebahagiaan, harapan baru, dan ketulusan, buket ini cocok untuk mengirim semangat dan merayakan momen spesial, seperti ulang tahun, graduation, ucapan semangat, apresiasi, dll.\r\n\r\nRangkaian ini mengkombinasikan sunflower yang cerah, gompie pink, baby rose, dan calimero kuning menambah kesan yang ceria.\r\n\r\nTinggi bouquet ± 45–55 cm.', 'flower'),
	(29, 'Strawberry Bouquet', 250000, 'Strawberry Bouquet adalah rangkaian unik yang memadukan manisnya strawberry segar dengan sentuhan lembut bunga filler pilihan. Melambangkan cinta yang tulus, perhatian, dan kehangatan, buket ini menjadi hadiah sempurna untuk menyampaikan rasa sayang dengan cara yang berbeda dan berkesan.\r\n\r\nBouquet ini terdiri dari 24 buah strawberry dan baby\'s breath sebagai filler.\r\n\r\nTinggi bouquet ± 45–55 cm.', 'flower'),
	(30, 'Medium Teddy Charm', 520000, 'Teddy Charm adalah perpaduan 20 tangkai bunga mawar dengan menambahkan boneka teddy bear. Rangkaian yang mengkombinasikan bunga dengan boneka termasuk dalam rangkaian modern, adanya boneka dalam rangkaian ini memberikan kesan sweet, cute, dan elegan.\r\n\r\nTinggi bouquet ± 60–70 cm.', 'flower'),
	(31, 'Dusty Money Bouquet', 475000, 'Dusty Money Bouquet adalah buket eksklusif yang memadukan lembaran uang tersusun rapi dengan bunga segar, menghadirkan kesan mewah, elegan dan penuh makna.\r\nBuket ini cocok untuk graduation, birthday, engagement, promotion atau momen special lainnya.\r\n\r\nTinggi bouquet ± 60 - 70 cm', 'flower'),
	(32, 'Sustainable Bouquet', 160000, 'Rangkaian bunga ramah lingkungan dengan wrapping daun pisang yang alami dan elegan. Menghadirkan kesan earthy, unik, dan berkelanjutan tanpa plastik. Kombinasi bunga segar dipadukan dengan tekstur daun yang eksotis, menciptakan tampilan modern namun natural.\r\n\r\nSelain rangkaian sunflower ini, kamu juga bisa diskusikan dengan admin untuk jenis bunga lainnya.\r\n\r\nTinggi bouquet ± 30 – 40 cm', 'flower'),
	(33, 'Rose Round Bouquet', 295000, 'Rose Round Bouquet ini adalah rangkaian klasik yang memadukan kemewahan 10 tangkai rose merah sebagai simbol cinta, dipadukan dengan lembut baby\'s breath putih yang melambangkan ketulusan dan keabadian. Dibentuk dengan teknik hand-tied yang rapi dan elegan, menghasilkan tampilan timeless dan romantis.\r\n\r\nTinggi bouquet ± 25 - 30 cm.\r\nDiameter ± 15 cm.', 'wedding'),
	(34, 'Blushing Garden Bouquet', 460000, 'Blushing Garden Bouquet adalah rangkaian bunga bernuansa pink lembut yang memancarkan kehangatan, kebahagiaan, dan kasih sayang yang tulus. Kombinasi lily dan mawar yang mekar anggun memberikan kesan mewah sekaligus romantis, menjadikannya pilihan sempurna untuk merayakan cinta, ulang tahun, anniversary, kelulusan, atau sebagai hadiah istimewa untuk orang yang tersayang.\r\n\r\nTinggi bouquet ± 45–50 cm', 'flower'),
	(35, 'Violet Tulip Bouquet', 995000, 'Violet Tulip Bouquet adalah rangkaian tulip ungu yang memancarkan keanggunan, kekuatan, dan keindahan yang berkelas. Warna ungu pada tulip melambangkan kemewahan dan penghargaan yang mendalam. Dibalut dengan gaya modern dan minimalis, buket ini membawa kesan premium namun tetap lembut, cocok untuk Anda yang ingin memberikan hadiah yang bermakna dan berkesan.\r\n\r\nTinggi bouquet ± 40–45 cm.', 'flower'),
	(36, 'Pink Delight Bouquet', 200000, 'Pink Delight Bouquet adalah Rangkaian bunga yang penuh keceriaan dan kelembutan, memadukan rose pink yang melambangkan kasih sayang dan perhatian tulus, bersama gerbera putih yang murni, optimisme, dan kebahagiaan yang baru. Sentuhan baby’s breath putih memberikan kesan ringan, suci, dan harapan yang abadi.\r\n\r\nRangkaian ini cocok untuk ulang tahun, ucapan semangat, apresiasi, momen spesial, dan hadiah untuk orang tercinta.\r\n\r\nTinggi bouquet ± 35–45 cm', 'flower'),
	(37, 'Large Artificial Lily Bouquet', 700000, 'Rangkaian bunga artificial premium bernuansa pastel dengan perpaduan lily, mawar, dan calla lily yang tampak natural dan elegan. Bouquet artificial flowers ini tahan lama tanpa perawatan, warna tidak mudah pudar, dan aman untuk penerima alergi bunga. Hadiah0 sempurna untuk ulang tahun, wisuda, anniversary, atau dekorasi ruangan sebagai simbol cinta dan kehangatan yang abadi.\r\n\r\nTinggi bouquet ± 45 – 50 cm', 'flower'),
	(38, 'Medium Peachy Bouquet', 495000, 'Medium Peachy Bouquet adalah rangkaian bunga lembut bernuansa peach dan ivory yang membawa kesan hangat dan menenangkan. Perpaduan mawar peach, gerbera putih, alstroemeria, dan baby breath menciptakan tampilan romantis yang elegan, simbol kasih sayang tulus dan harapan baik untuk masa depan.\r\n\r\nRangkaian ini cocok untuk momen spesial seperti ulang tahun, anniversary, wisuda, dan ucapan congratulations.\r\n\r\nTinggi bouquet ± 45–50 cm.', 'flower'),
	(39, 'Pink Royale Money Bouquet', 444000, 'Bouquet istimewa bernuansa pink elegan yang memadukan rangkaian uang dengan artificial flowers berkualitas premium. Sentuhan mawar pink dan filler flowers menambah kesan romantis dan mewah, menjadikan rangkaian ini simbol apresiasi, keberuntungan, dan harapan akan kemakmuran.\r\n\r\nDibungkus dengan wrapping warna soft pink dan jaring glitter yang mempesona, buket ini tampil megah dan berkelas, sempurna untuk merayakan momen spesial seoerti hadiah ulang tahun, anniversary, wisuda, lamaran, dan ucapan selamat atas pencapaian besar.\r\n\r\nBouquet ini juga memiliki makna kemakmuran, cinta yang tulus, dan doa terbaik untuk masa depan.\r\n\r\nTinggi bouquet ± 55 – 65 cm.', 'flower'),
	(40, 'Medium Violet Bloombox', 612000, 'Violet Bloombox adalah rangkaian flower box bernuansa magenta dan ungu yang memancarkan kesan elegan, berani, dan penuh kehangatan. Komposisi bunga rose magenta, aster ungu, orchid merah marun, dan filler bernuansa pastel menciptakan harmoni yang cantik dan hidup, cocok untuk mempermanis ruangan ataupun sebagai hadiah penuh kesan.\r\n\r\nWarna magenta melambangkan cinta yang kuat dan penghargaan mendalam, sementara ungu membawa makna kreativitas, kemewahan, dan harapan untuk masa depan yang lebih indah. Dengan desain compact dalam box gradasi soft, rangkaian ini tampak modern dan menawan.\r\n\r\nCocok untuk hadiah ulang tahun, ucapan selamat, anniversary, corporate gift, dekorasi rumah & meja kerja.\r\n\r\nTinggi bloom box ± 35 – 45 cm.', 'flower'),
	(41, 'Sunflower Lily Bloom Box', 775000, 'Rangkaian bunga cerah penuh kehangatan ini memadukan keindahan sunflower, lily putih, mawar putih & kuning, serta carnation peach & kuning dalam sebuah box berukuran medium yang bernuansa elegan. Kombinasi warna kuning, putih, dan peach melambangkan kebahagiaan, kemurnian hati, dan apresiasi yang tulus, menjadikannya pilihan sempurna untuk mengirimkan energi positif dan doa terbaik.\r\n\r\nDisusun dengan sentuhan artistik dan detail yang rapi, rangkaian ini menghadirkan kesan fresh, modern, dan penuh keceriaan, cocok untuk merayakan momen berbahagia bersama orang terkasih.\r\n\r\nTinggi bloom box ± 45–50 cm', 'flower'),
	(42, 'Money Bloom Box', 660000, 'Money Bloom Box ini menghadirkan perpaduan mewah antara bunga dan elemen greenery yang segar, dipadukan dengan penyusunan rangkaian uang yang tertata rapi dan elegan. Desain premium dengan box silver bertekstur memberikan kesan berkelas, modern, dan sangat berkesan sebagai hadiah bernilai.\r\n\r\nKombinasi warna lembut dan elegan melambangkan kehangatan, penghargaan, dan harapan terbaik, sementara sentuhan rangkaian uang menjadikan hadiah ini bukan hanya indah dipandang tetapi juga memiliki nilai yang bermanfaat dan penuh kejutan.\r\n\r\nLebar bloom box ± 30 – 45 cm.', 'flower'),
	(43, 'Tulip Royal Blue Bloom Box', 925000, 'Tulip Royal Blue Bloom box ini menghadirkan sentuhan keindahan yang tenang dan berkelas. Rangkaian memadukan mawar putih dan biru, tulip biru yang menjadi pusat perhatian, diperkaya dengan aksen silver foliage yang memberikan kesan modern dan elegan. Nuansa warna dingin yang lembut menciptakan aura kedamaian, kepercayaan, dan ketulusan—menjadikannya hadiah yang penuh makna.\r\n\r\nDidesain dalam box premium silver, rangkaian ini tampil mewah dan eksklusif, ideal sebagai hadiah untuk merayakan pencapaian maupun menyampaikan apresiasi dengan cara yang berkesan.\r\n\r\nTinggi bloom box ± 35 – 45 cm.', 'flower'),
	(44, 'Sincere Buddy Bloom Box', 735000, 'Bloom box manis bernuansa dusty pink ini menghadirkan perpaduan elegan antara mawar amnesia dan eucalyptus segar yang dirangkai secara lembut dan modern. Sentuhan boneka pebby bear memberikan nuansa hangat, lembut, dan penuh kasih, menjadikannya hadiah yang ideal untuk mengekspresikan perhatian dan cinta dalam cara yang manis dan berkesan.\r\n\r\nWarna dusty pink melambangkan rasa sayang yang dewasa, kelembutan, dan ketulusan hati, cocok untuk diberikan kepada orang terdekat yang ingin Anda buat tersenyum.\r\n\r\nTinggi bloom box ± 35 – 45 cm.', 'flower'),
	(45, 'Elegance Noir Bloom Box', 935000, 'Elegance Noir Bloom Box adalah rangkaian bunga dalam box yang memadukan keanggunan mawar merah premium dengan sentuhan eksotis eucalyptus hitam. Komposisi warna kontras merah dan hitam menciptakan kesan dramatis, elegan, dan penuh kekuatan. Dihias dengan pita organza hitam berukuran besar yang mempertegas karakter mewah dan modern.\r\n\r\nRangkaian ini melambangkan cinta mendalam, keberanian, kekuatan hati, serta penghormatan yang tinggi. Cocok untuk momen spesial seperti anniversary, romantic surprise, congratulation, hingga sebagai gesture penghargaan yang penuh wibawa.\r\n\r\nTinggi bloom box ± 35 – 45 cm.', 'flower'),
	(50, 'Joyful Celebration Bloom Box', 525000, 'Joyful Celebration Bloom Box adalah rangkaian penuh keceriaan dan kehangatan yang dibuat khusus untuk momen ulang tahun, ucapan selamat, atau perayaan spesial lainnya. Menghadirkan kombinasi bunga segar seperti mawar putih, mawar merah mini, daisy putih dan aster kuning, serta bunga kertas poppy yang memberikan sentuhan artistik dan modern.\r\n\r\nDilengkapi dengan ruang khusus untuk menambahkan hadiah seperti gadget, aksesoris, atau hadiah lainnya. Menjadikan rangkaian ini pilihan istimewa dan personal untuk orang tersayang.\r\n\r\nTinggi bloom box ± 35 – 45 cm.', 'flower'),
	(51, 'Royal Blue Jasmine Pomander Bouquet', 750000, 'Royal Blue Jasmine Pomander Bouquet adalah buket pernikahan modern yang memadukan keanggunan artificial orchid biru, kemewahan artificial amaranthus, dan sentuhan sakral dari melati segar yang menjuntai lembut. Dirancang dengan gaya pomander, buket ini menciptakan siluet memanjang yang elegan, menjadikannya pilihan sempurna untuk pengantin yang ingin tampil standout dan penuh karakter.\r\n\r\nCocok untuk pengantin yang menginginkan buket unik, fotogenik, dan tahan seharian.\r\n\r\nTinggi Wedding Bouquet ± 40–45 cm | Lebar ± 35 cm', 'wedding'),
	(52, 'Aurora Bloom Cascade Bouquet', 1000000, 'Aurora Bloom Cascade Bouquet adalah rangkaian bunga segar yang memadukan kelembutan warna pink dan peach dalam komposisi yang anggun dan romantis. Dengan siluet cascade yang mengalir lembut, buket ini menghadirkan kesan mewah namun tetap natural, cocok untuk pengantin yang menginginkan tampilan feminin, elegan, dan timeless.\r\n\r\nRangkaiannya terdiri dari anggrek pink, lily, mawar quicksand, chrysanthemum, baby’s breath, serta aksen artificial amaranthus yang menambah efek jatuh. Perpaduan elemen ini menciptakan buket yang kaya tekstur, lembut dipandang, dan sangat fotogenik untuk momen pernikahan.\r\n\r\nMelambangkan cinta yang anggun, harapan baru, dan ketulusan yang mengalir, buket ini cocok untuk berbagai tema wedding mulai dari modern romantic, garden wedding, hingga indoor intimate celebration.\r\n\r\nTinggi Wedding Bouquet ± 60–65 cm | Lebar ± 35–40 cm', 'wedding'),
	(53, 'White Serenity Contemporary Bouquet', 620000, 'White Serenity Contemporary Bouquet ini menghadirkan keindahan yang lembut dan anggun melalui perpaduan anggrek, anthurium, lily putih, dan sentuhan mawar soft pink, diperkaya dengan foliage hijau natural yang memberi kesan segar dan seimbang. Komposisi asimetris dengan aksen menjuntai menciptakan siluet modern namun tetap romantis.\r\n\r\nPalet warna putih dan pastel melambangkan kesucian, ketulusan, dan awal yang baru, sangat sesuai untuk akad, pemberkatan, maupun intimate wedding.\r\n\r\nBouquet ini nyaman digenggam, dan tetap terlihat sempurna sepanjang acara pilihan ideal bagi pengantin yang menginginkan tampilan timeless, rapi, dan effortless elegance tanpa khawatir layu di hari istimewa.\r\n\r\nTinggi Wedding Bouquet ± 30–35 cm | Lebar ± 45 cm', 'wedding'),
	(54, 'Pure Vow Hand Tied Bouquet', 410000, 'Pure Vow Hand Tied Bouquet ini menampilkan perpaduan elegan antara mawar putih, calla lily blush, dan lisianthus putih, dipadukan dengan sentuhan foliage hijau natural yang ringan. Aksen amaranthus menjuntai menghadirkan nuansa tradisional yang anggun sekaligus romantis.\r\n\r\nDesain hand tied dengan siluet ramping memberi kesan modern dan effortless, cocok untuk pengantin yang menyukai tampilan natural namun tetap berkarakter. Perpaduan warna putih dan blush melambangkan kesucian, ketulusan, dan kelembutan cinta, menjadikan bouquet ini ideal untuk akad, intimate wedding, maupun prosesi sakral dengan sentuhan adat.\r\n\r\nBouquet ini terasa ringan saat digenggam, fotogenik, dan memberikan kesan timeless bridal elegance dengan detail yang bermakna.\r\n\r\nTinggi Wedding Bouquet ± 30 cm | Lebar ± 25 cm', 'wedding');

-- Dumping structure for table ilmisgarden_db.product_images
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_primary` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_product_images` (`product_id`),
  CONSTRAINT `fk_product_images` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden_db.product_images: ~34 rows (approximately)
INSERT INTO `product_images` (`id`, `product_id`, `image`, `is_primary`, `created_at`) VALUES
	(1, 17, 'img/pr/1762403454_Red Noir.png', 1, '2025-12-28 04:26:02'),
	(2, 18, 'img/pr/1762403536_IMG_1523.jpg', 1, '2025-12-28 04:26:02'),
	(3, 19, 'img/pr/1762403689_Sunshine Bliss Bouquet 1.png', 1, '2025-12-28 04:26:02'),
	(4, 20, 'img/pr/1762403708_Rosé Amour Bouquet.png', 1, '2025-12-28 04:26:02'),
	(5, 21, 'img/pr/1764310814_Gambar WhatsApp 2025-11-11 pukul 11.18.05_1d550a51.jpg', 1, '2025-12-28 04:26:02'),
	(6, 22, 'img/pr/1764311112_Gambar WhatsApp 2025-11-11 pukul 11.20.11_dbc17a26.jpg', 1, '2025-12-28 04:26:02'),
	(7, 23, 'img/pr/1764312079_Gambar WhatsApp 2025-11-11 pukul 11.21.12_0c79bc98.jpg', 1, '2025-12-28 04:26:02'),
	(8, 24, 'img/pr/1764397061_Gambar WhatsApp 2025-11-11 pukul 12.40.59_56ac68fc.jpg', 1, '2025-12-28 04:26:02'),
	(9, 25, 'img/pr/1764398833_Gambar WhatsApp 2025-11-12 pukul 12.23.23_b421ea40.jpg', 1, '2025-12-28 04:26:02'),
	(10, 26, 'img/pr/1764400600_Gambar WhatsApp 2025-11-24 pukul 13.04.51_09423aa5.jpg', 1, '2025-12-28 04:26:02'),
	(11, 27, 'img/pr/1764410743_a784ce6a-f084-4f0b-a974-49c6b41d13a2.jpg', 1, '2025-12-28 04:26:02'),
	(12, 28, 'img/pr/1764412451_c9051c87-d381-4f40-be33-68adab4733c2.jpg', 1, '2025-12-28 04:26:02'),
	(13, 29, 'img/pr/1764412766_a75a0622-8e06-4499-a483-625432f41916.jpg', 1, '2025-12-28 04:26:02'),
	(14, 30, 'img/pr/1764413427_Gambar WhatsApp 2025-11-29 pukul 17.43.21_81781cb3.jpg', 1, '2025-12-28 04:26:02'),
	(15, 31, 'img/pr/1764413931_IMG_3645.jpg', 1, '2025-12-28 04:26:02'),
	(16, 32, 'img/pr/1764414766_IMG_9700.jpg', 1, '2025-12-28 04:26:02'),
	(17, 33, 'img/pr/1764416000_224a160a-8e29-4369-86aa-16445f016a90.jpg', 1, '2025-12-28 04:26:02'),
	(18, 34, 'img/pr/1764488187_IMG_1546.jpg', 1, '2025-12-28 04:26:02'),
	(19, 35, 'img/pr/1764499207_9c65b67c-918a-42be-96ea-af8eb7030753.jpg', 1, '2025-12-28 04:26:02'),
	(20, 36, 'img/pr/1764654613_Gambar WhatsApp 2025-11-27 pukul 13.08.16_48141392.jpg', 1, '2025-12-28 04:26:02'),
	(21, 37, 'img/pr/1764658279_9e736459-4cc7-4219-b056-462a8d1bfd2d.jpg', 1, '2025-12-28 04:26:02'),
	(22, 38, 'img/pr/1764658841_16e44b60-da5f-4a3e-9d3e-0598c41d94ef.jpg', 1, '2025-12-28 04:26:02'),
	(23, 39, 'img/pr/1764660191_4c4531e2-6ad7-4d94-a9c4-6cbefb431598.jpg', 1, '2025-12-28 04:26:02'),
	(24, 40, 'img/pr/1764671041_Gambar WhatsApp 2025-12-02 pukul 14.05.10_0f08c337.jpg', 1, '2025-12-28 04:26:02'),
	(25, 41, 'img/pr/1764836668_DSC09986.JPG', 1, '2025-12-28 04:26:02'),
	(26, 42, 'img/pr/1764837400_DSC09614.JPG', 1, '2025-12-28 04:26:02'),
	(27, 43, 'img/pr/1764838004_IMG_96444.jpg', 1, '2025-12-28 04:26:02'),
	(28, 44, 'img/pr/1764842612_DSC09165.JPG', 1, '2025-12-28 04:26:02'),
	(29, 45, 'img/pr/1765004647_DSC09160.JPG', 1, '2025-12-28 04:26:02'),
	(30, 50, 'img/pr/1765448365_DSC01829 (1).jpg', 1, '2025-12-28 04:26:02'),
	(31, 51, 'img/pr/1765449128_Gambar WhatsApp 2025-11-25 pukul 13.54.53_ec4c6c13.jpg', 1, '2025-12-28 04:26:02'),
	(32, 52, 'img/pr/1765449659_Gambar WhatsApp 2025-11-25 pukul 13.54.37_13d3f918.jpg', 1, '2025-12-28 04:26:02'),
	(33, 53, 'img/pr/1766723970_56cfb519-fe07-4296-b96c-607dd94903af.jpg', 1, '2025-12-28 04:26:02'),
	(34, 54, 'img/pr/1766815911_9b19438e-be4a-4bfe-aec2-953bfdd86e14.jpg', 1, '2025-12-28 04:26:02');

-- Dumping structure for table ilmisgarden_db.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id_transaction` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `total_items` int(11) NOT NULL,
  `subtotal` bigint(20) NOT NULL,
  `status` enum('belum diproses','diproses','selesai') DEFAULT 'belum diproses',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_transaction`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden_db.transactions: ~2 rows (approximately)
INSERT INTO `transactions` (`id_transaction`, `user_id`, `total_items`, `subtotal`, `status`, `created_at`) VALUES
	(1, 'IL003', 6, 60000, 'selesai', '2025-09-10 04:18:56'),
	(2, 'IL006', 1, 1922901, 'belum diproses', '2025-10-30 03:04:13');

-- Dumping structure for table ilmisgarden_db.transaction_items
CREATE TABLE IF NOT EXISTS `transaction_items` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  PRIMARY KEY (`id_item`),
  KEY `transaction_id` (`transaction_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `transaction_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id_transaction`) ON DELETE CASCADE,
  CONSTRAINT `transaction_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden_db.transaction_items: ~0 rows (approximately)

-- Dumping structure for table ilmisgarden_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` text NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table ilmisgarden_db.users: ~9 rows (approximately)
INSERT INTO `users` (`id_user`, `username`, `email`, `whatsapp`, `password`, `date_of_birth`, `created_at`, `address`) VALUES
	('IL001', 'baros', 'andrianbaros46@gmail.com', '', '$2y$10$uZozSrM25US9Iz8NpJvOYuReuBDIhj/a/pJgra5RGWsVW5nb7YDYi', '2003-01-08', '2025-09-07 19:19:39', 'KBB'),
	('IL002', 'Ryuuou', 'a@a.a', '', '$2y$10$TPMrRNj.m4MamtAG6m/U2.03eqAJNg2gvCKJPTpk7wjS202/noRGq', '2025-09-08', '2025-09-08 04:23:10', 'a'),
	('IL003', 'chef', 'aji.10121095@mahasiswa.unikom.ac.id', '', '$2y$10$DajmbiKrGmVccFzNVoLm1eMmDfN/KLe5qVJe8JnC9nakLGRbTvm5q', '2025-09-08', '2025-09-08 16:30:41', ''),
	('IL004', 'dapin', 'dhafin1919@gmail.com', '', '$2y$10$9npJSepo5JOuID//EAkaaeH5CamxBGMw.zE14./S9D1w7K9r2Flo2', '2002-06-13', '2025-10-01 08:29:32', ''),
	('IL005', 'ilmisgarden', 'ilmisgarden@gmail.com', '', '$2y$10$jnLdy4rR1k1LxvFQJDFq2ezSDZ16Kn3uEVhpozUhBmvXyi6f2rO5y', '2020-01-01', '2025-10-09 11:15:48', ''),
	('IL006', 'baros', 'anjaymabar@gmail.com', '', '$2y$10$.tErAprp5WMblFNGInjb4OzxK5PQ6LTzL95KAEf2JUB7lgz4Gli/a', '2025-10-28', '2025-10-30 03:03:45', ''),
	('IL007', 'nurulilmiss', 'nurulilmisuhada@gmail.com', '', '$2y$10$FOnxBm3/xYbzqbwUujbRfe9GCNCH6UbUt2sUIQST2xlGY/giia8Uq', '1995-12-15', '2025-11-27 15:45:23', 'Jl. Raya Golf Dago No.4'),
	('IL008', 'levinakun05@gmail.com', 'levinakun05@gmail.com', '', '$2y$10$0iTX7.tuB3CCVmUyhvTZFuXFiSwuCIumQ1YY.N6dWjpemVfLB4Cy.', '1993-06-16', '2025-11-28 06:35:19', 'Jalan raya nanjung'),
	('IL009', 'baros10', 'baros10@gmail.com', '0888888888', '$2y$10$asKNip80gip8Q32XRYrqROEYvtmol0y4.PfRIxUm4BLGnhEa1KjbO', '1999-02-24', '2025-12-28 03:48:35', 'baros'),
	('IL010', 'dapin123', 'dhafinmuhammad8@gmail.com', '089621066529', '$2y$10$J5CRCr08NrqVecPfO/RWT.ocoEN3PxHrGz2GRZkO76GGjZYkE0UkO', '2002-08-19', '2025-12-28 05:25:38', 'RTd21321');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
