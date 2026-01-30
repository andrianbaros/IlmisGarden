<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IlmisGarden</title>
    <link rel="icon" href="img/F4F6F4-full.png" />

    <!-- Fonts -->
    <!-- 1. Preconnect ke Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <!-- 2. Preload stylesheet Google Fonts -->
    <link
      rel="preload"
      as="style"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
    />

    <!-- 3. Load stylesheet font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />

    <!-- 4. Fallback untuk browser lama / tanpa JavaScript -->
    <noscript>
      <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
        rel="stylesheet"
      />
      <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet"
      />
    </noscript>

    <!-- Icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />

    <script src="https://unpkg.com/feather-icons"></script>

    <link rel="stylesheet" href="css/bouquet.css" />
  </head>
  <body>
    <!-- Navbar Start -->
    <nav class="navbar">

      <a href="index.php" class="navbar-logo">
  <img src="img/F4F6F4-full.png" alt="Logo" style="width: 200px; height: auto;" />
</a>
      <div class="navbar-nav">
        <a href="product.php">Product</a>
        <a href="shop.php">Catalog</a>
        <a href="index.php#about">About Us</a>
      </div>
      <div class="navbar-extra">
      <a href="cart.php" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
        <a href="profile.php" id="user"><i data-feather="user"></i></a>
        <i id="menu" data-feather="menu"></i>
      </div>
    </nav>

    <!-- Navbar End -->

  <!-- Hero Section -->
  <section class="hero">
    <h1 class="left">Crafted with Love</h1>
    <img src="img/rose.png" alt="Rose" class="hero-img">
    <h1 class="right"> Created to Bloom</h1>
  </section>
<!-- Blooming Collection -->
<section class="collection">
  <table class="collection-table">
    <tr>
      <td class="left">Explore</td>
      <td class="right">Our</td>
    </tr>
    <tr>
      <td colspan="2" class="center">Blooming Collection</td>
    </tr>
  </table>
  <div class="collection-wrapper">
    <div class="collection-text">
      <p>Find Your Perfect<br> Bouquet Flowers</p>
    </div>
    <div class="collection-grid">
      <img src="img/Frame 153.png" alt="Collection 1">
      <img src="img/Frame 154.png" alt="Collection 2">
      <img src="img/Frame 152.png" alt="Collection 3">
    </div>
  </div>
</section>



  <!-- Flower Bouquet Section -->
  <section class="flower-bouquet">
    <h2>Flower Bouquet</h2>
    <p>Beautifully arranged to brighten your day.</p>
    <div class="circle-images">
      <img src="img/Ellipse 5.png" alt="Bouquet 1">
      <img src="img/Ellipse 6.png" alt="Bouquet 2">
      <img src="img/Ellipse 7.png" alt="Bouquet 3">
    </div>
  </section>

  <!-- Static Catalog (per jenis bunga) -->
  <section class="catalog">
    <!-- Omakase -->
    <div class="catalog-item gray">
      <h3>Omakase</h3>
      <div class="desc-catalog">
      <p>Kami pilihkan bunga-bunga yang terbagus di hari ini agar kamu mendapatkan kualitas terbaik,</p> 
      <p>bisa jadi mix and match berbagai jenis bunga dengan tema warna dan budget sesuai </p>
      <p>permintaan.</p>
      </div>
      <div class="catalog-content">
        <img src="img/Frame 157.png" alt="Omakase 1">
        <img src="img/Frame 158.png" alt="Omakase 2">
        <img src="img/Frame 1581.png" alt="Omakase 3">
      </div>
      <p>Kami berterima kasih atas kesempatan dan kepercayaan yang kamu berikan sebagai florist pilihanmu.</p>

    </div>
    <!-- Rose -->
    <div class="catalog-item gray">
      <h3>Rose</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"><b>Single Rose</b> start from 50k</div>
          <img src="img/rose1.png" alt="Rose 1">
          <div class="caption-bottom">1 Stem Rose</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Petite Rose</b> start from 85k</div>
          <img src="img/rose2.png" alt="Rose 2">
          <div class="caption-bottom">3 Stem Rose + Filler, etc</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Small Rose</b> start from 155k</div>
          <img src="img/rose3.png" alt="Rose 3">
          <div class="caption-bottom">> 5 Stem Rose + Foliage, etc</div>
        </div>
      </div>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"><b>Medium Rose</b> start from 355k</div>
          <img src="img/rose4.png" alt="Rose 4">
          <div class="caption-bottom">> 10 Stem Rose + Foliage, etc</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Large Rose</b> start from 450k</div>
          <img src="img/rose5.png" alt="Rose 5">
          <div class="caption-bottom">> 20 Stem Rose + Foliage, etc</div>
        </div>
      </div>
      <p>Rangkaian dengan bunga utama bunga <b>Mawar</b>, bisa dikombinasi dengan daun, filler, dan bunga lain.</p>
      <p>*Rangkaian bisa dibuat ke dalam vase, box, basket, dengan penambahan harga yang tercantum pada halaman <b>add on.</b></p>
      <div class="colors">
        <span style="background:red"></span>
        <span style="background:pink"></span>
        <span style="background:orange"></span>
        <span style="background:yellow"></span>
        <span style="background:purple"></span>
      </div>
    </div>

    <!-- Hydrangea -->
    <div class="catalog-item gray">
      <h3>Hydrangea</h3>
      <div class="catalog-content">
      <div class="image-wrapper">
          <div class="caption-top"><b>Single Hydrangea Blue</b> start from 77k</div>
          <img src="img/Hydrangea1.png" alt="Hydrangea 1">
          <div class="caption-bottom"></div>
        </div>
      
      <div class="image-wrapper">
          <div class="caption-top"><b>Single Hydrangea Purple</b> start from 126k</div>
          <img src="img/Hydrangea2.png" alt="Hydrangea 2">
          <div class="caption-bottom"></div>
        </div>

      <div class="image-wrapper">
          <div class="caption-top"><b>Small Hydrangea</b> start from 160k</div>
          <img src="img/Hydrangea3.png" alt="Hydrangea 3">
          <div class="caption-bottom"></div>
        </div>
      </div>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"><b>Medium Hydrangea</b> start from 250k</div>
          <img src="img/Hydrangea4.png" alt="Hydrangea 4">
          <div class="caption-bottom">1 Stem Hydrangea + Foliage, Rose, etc</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Large Hydrangea</b> start from 580k</div>
          <img src="img/Hydrangea5.png" alt="Hydrangea 5">
          <div class="caption-bottom">2 Stem Hydrangea + Foliage, Rose, etc</div>
        </div>
      </div>
      <p>Rangkaian dengan bunga utama bunga <b>Hydrangea</b>, bisa dikombinasi dengan daun, filler, dan bunga lain.</p>
      <p>*Rangkaian bisa dibuat ke dalam vase, box, basket, dengan penambahan harga yang tercantum pada halaman <b>add on.</b></p>
      <div class="colors">
        <span style="background:blue"></span>
        <span style="background:violet"></span>
        <span style="background:purple"></span>
      </div>
    </div>

    <!-- Tambah section lain: Peony, Gypsophila, Sunflower, dll sesuai desain -->

    <!-- Pom Pom -->
    <div class="catalog-item gray">
      <h3>Pom Pom</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"><b>Single Pom Pom</b> start from 80k</div>
          <img src="img/PomPom1.png" alt="Pom Pom 1">
          <div class="caption-bottom">1 Stem Pom Pom + Foliage, Rose, etc</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Medium Pom Pom</b> start from 350k</div>
          <img src="img/PomPom2.png" alt="Pom Pom 2">
          <div class="caption-bottom">3 Stem Pom Pom + Foliage, Rose, etc</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Large Pom Pom</b> start from 450k</div>
          <img src="img/PomPom3.png" alt="Pom Pom 3">
          <div class="caption-bottom">> 10 Stem Pom Pom + Foliage, Rose, etc</div>
        </div>
      </div>
      <p>Rangkaian dengan bunga utama bunga <b>Pom Pom</b>, bisa dikombinasi dengan daun, filler, dan bunga lain.</p>
      <p>*Rangkaian bisa dibuat ke dalam vase, box, basket, dengan penambahan harga yang tercantum pada halaman <b>add on.</b></p>
      <div class="colors">
        <span style="background:orange"></span>
        <span style="background:pink"></span>
        <span style="background:green"></span>
        <span style="background:yellow"></span>
        <span style="background:purple"></span>
      </div>
    </div>

        <!-- Gompie -->
      <div class="catalog-item gray">
      <h3>Small Gompie</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"><b>Single Gompie</b> start from 170k</div>
          <img src="img/Gompie1.png" alt="Small Gompie 1">
          <div class="caption-bottom">> 2 Stem Gompie + Foliage, Rose, etc</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Medium Gompie</b> start from 280k</div>
          <img src="img/Gompie2.png" alt="Small Gompie 2">
          <div class="caption-bottom">> 5 Stem Gompie + Foliage, Rose, etc</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Large Gompie</b> start from 520k</div>
          <img src="img/Gompie3.png" alt="Small Gompie 3">
          <div class="caption-bottom">> 10 Stem Gompie + Foliage, Rose, etc</div>
        </div>
      </div>
      <p>Rangkaian dengan bunga utama bunga <b>Gompie</b>, bisa dikombinasi dengan daun, filler, dan bunga lain.</p>
      <p>*Rangkaian bisa dibuat ke dalam vase, box, basket, dengan penambahan harga yang tercantum pada halaman <b>add on.</b></p>
      <div class="colors">
        <span style="background:orange"></span>
        <span style="background:pink"></span>
        <span style="background:green"></span>
        <span style="background:yellow"></span>
      </div>
    </div>

      <!-- Sunflower -->
  <div class="catalog-item gray">
    <h3>Small Sunflower</h3>
    <div class="catalog-content">
      <div class="image-wrapper">
        <div class="caption-top"><b>Single Sunflower</b> start from 100k</div>
        <img src="img/Sunflower1.png" alt="Small Sunflower 1">
        <div class="caption-bottom">1 Stem Sunflower</div>
      </div>

      <div class="image-wrapper">
        <div class="caption-top"><b>Small Sunflower</b> start from 170k</div>
        <img src="img/Sunflower2.png" alt="Small Sunflower 2">
        <div class="caption-bottom">1 Stem Sunflower + Foliage, Rose, etc</div>
      </div>
    </div>
      
    <div class="catalog-content">
      <div class="image-wrapper">
        <div class="caption-top"><b>Medium Sunflower</b> start from 430k</div>
        <img src="img/Sunflower3.png" alt="Small Sunflower 3">
        <div class="caption-bottom">> 3 Stem Sunflower + Foliage, Rose, etc</div>
      </div>

      <div class="image-wrapper">
        <div class="caption-top"><b>Large Sunflower</b> start from 550k</div>
        <img src="img/Sunflower4.png" alt="Small Sunflower 3">
        <div class="caption-bottom">> 5 Stem Sunflower + Foliage, Rose, etc</div>
      </div>
    </div>
    <p>Rangkaian dengan bunga utama bunga <b>Sunflower</b>, bisa dikombinasi dengan daun, filler, dan bunga lain.</p>
    <p>*Rangkaian bisa dibuat ke dalam vase, box, basket, dengan penambahan harga yang tercantum pada halaman <b>add on.</b></p>
    <div class="colors">
      <span style="background:orange"></span>
      <span style="background:green"></span>
      <span style="background:yellow"></span>
    </div>
  </div>

    <!-- Gerbera -->
    <div class="catalog-item gray">
      <h3>Gerbera</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"><b>Gerbera</b> only</div>
          <img src="img/Gerbera1.png" alt="Gerbera 1">
          <div class="caption-bottom">5 Stem 150k</div>
          <div class="caption-bottom">10 Stem 200k</div>
          <div class="caption-bottom">20 Stem 350k</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Mix Gerbera</b> start from 300k</div>
          <img src="img/Gerbera3.png" alt="Gerbera 2">
          <div class="caption-bottom">5 Stem Gerbera + Foliage, Rose, etc</div>
        </div>
      </div>
      <p>Rangkaian dengan bunga utama bunga <b>Gerbera</b>, bisa dikombinasi dengan daun, filler, dan bunga lain.</p>
      <p>*Rangkaian bisa dibuat ke dalam vase, box, basket, dengan penambahan harga yang tercantum pada halaman <b>add on.</b></p>
      <div class="colors">
        <span style="background:pink"></span>
        <span style="background:green"></span>
      </div>
    </div>

        <!-- Lily -->
        <div class="catalog-item gray">
      <h3>Lily</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"><b>Single Lily</b> start from 250k</div>
          <img src="img/Lily1.png" alt="Lily 1">
          <div class="caption-bottom">1 Stem Lily + Foliage, Rose, etc</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Medium Lily</b> start from 500k</div>
          <img src="img/Lily2.png" alt="Lily 2">
          <div class="caption-bottom">>2 Stem Lily + Foliage, Rose, etc</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Large Lily</b> start from 1.350k</div>
          <img src="img/Lily3.png" alt="Lily 3">
          <div class="caption-bottom">> 3 Stem Lily + Foliage, Rose, etc</div>
        </div>
      </div>
      <p>Rangkaian dengan bunga utama bunga <b>Lily</b>, bisa dikombinasi dengan daun, filler, dan bunga lain.</p>
      <p>*Rangkaian bisa dibuat ke dalam vase, box, basket, dengan penambahan harga yang tercantum pada halaman <b>add on.</b></p>
      <div class="colors">
        <span style="background:white"></span>
        <span style="background:pink"></span>
        <span style="background:green"></span>
      </div>
    </div>

        <!-- Dianthus -->
        <div class="catalog-item gray">
      <h3>Dianthus</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"><b>Single Dianthus</b> start from 300k</div>
          <img src="img/Dianthus1.png" alt="Dianthus 1">
          <div class="caption-bottom">> 5 Stem Dianthus + Foliage, Filler, etc</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Medium Dianthus</b> start from 555k</div>
          <img src="img/Dianthus2.png" alt="Dianthus 2">
          <div class="caption-bottom">> 10 Stem Dianthus + Foliage, Filler, etc</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Large Dianthus</b> start from 1.150k</div>
          <img src="img/Dianthus3.png" alt="Dianthus 3">
          <div class="caption-bottom">> 20 Stem Dianthus + Foliage, Filler, etc</div>
        </div>
      </div>
      <p>Rangkaian dengan bunga utama bunga <b>Dianthus</b>, bisa dikombinasi dengan daun, filler, dan bunga lain.</p>
      <p>*Rangkaian bisa dibuat ke dalam vase, box, basket, dengan penambahan harga yang tercantum pada halaman <b>add on.</b></p>
      <div class="colors">
        <span style="background:white"></span>
        <span style="background:pink"></span>
        <span style="background:green"></span>
      </div>
    </div>

        <!-- Lisianthus -->
        <div class="catalog-item gray">
      <h3>Lisianthus</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"><b>Single Lisianthus</b> start from 150k</div>
          <img src="img/Lisianthus1.png" alt="Lisianthus 1">
          <div class="caption-bottom">1 Stem Lisianthus + Foliage, Filler, etc</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Medium Lisianthus</b> start from 250k</div>
          <img src="img/Lisianthus2.png" alt="Lisianthus 2">
          <div class="caption-bottom">> Stem Lisianthus + Foliage, Rose, etc</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Large Lisianthus</b> start from 500k</div>
          <img src="img/Lisianthus3.png" alt="Lisianthus 3">
          <div class="caption-bottom">> 5 Stem Lisianthus + Foliage, Rose, etc</div>
        </div>
      </div>
      <p>Rangkaian dengan bunga utama bunga <b>Lisianthus</b>, bisa dikombinasi dengan daun, filler, dan bunga lain.</p>
      <p>*Rangkaian bisa dibuat ke dalam vase, box, basket, dengan penambahan harga yang tercantum pada halaman <b>add on.</b></p>
      <div class="colors">
        <span style="background:purple"></span>
        <span style="background:yellow"></span>
        <span style="background:green"></span>
        <span style="background:pink"></span>
      </div>
    </div>
    
        <!-- Money Bouquet -->
        <div class="catalog-item gray">
      <h3>Money Bouquet</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"><b>Small Money Bouquet</b> start from 80k</div>
          <img src="img/MoneyBouquet1.png" alt="Money Bouquet 1">
          <div class="caption-bottom"></div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Medium Money Bouquet</b> start from 400k</div>
          <img src="img/MoneyBouquet2.png" alt="Money Bouquet 2">
          <div class="caption-bottom"></div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Large Money Bouquet</b> start from 850k</div>
          <img src="img/MoneyBouquet3.png" alt="Money Bouquet 3">
          <div class="caption-bottom"></div>
        </div>
      </div>
      <p>Rangkaian dengan <b>Uang</b>, bisa dikombinasi dengan bunga, daun, dan filler lain.</p>
      <p>*Rangkaian bisa dibuat ke dalam vase, box, basket, dengan penambahan harga yang tercantum pada halaman <b>add on.</b></p>
      <div class="colors">
        <span style="background:red"></span>
        <span style="background:blue"></span>
        <span style="background:pink"></span>
      </div>
    </div>

        <!-- Artificial Flowers -->
        <div class="catalog-item gray">
      <h3>Artificial Flowers</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"><b>Small Artificial Flowers</b> start from 250k</div>
          <img src="img/ArtificialFlowers1.png" alt="Artificial Flowers 1">
          <div class="caption-bottom"></div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Medium Artificial Flowers</b> start from 500k</div>
          <img src="img/ArtificialFlowers2.png" alt="Artificial Flowers 2">
          <div class="caption-bottom"></div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Large Artificial Flowers</b> start from 700k</div>
          <img src="img/ArtificialFlowers3.png" alt="Artificial Flowers 3">
          <div class="caption-bottom"></div>
        </div>
      </div>
      <p>Rangkaian dengan bunga utama Bunga <b>Artifisial</b>, bisa dikombinasi dengan daun, filler, dan bunga lain. </p>
      <p>*Rangkaian bisa dibuat ke dalam vase, box, basket, dengan penambahan harga yang tercantum pada halaman <b>add on.</b></p>
      <div class="colors">
        <span style="background:yellow"></span>
        <span style="background:red"></span>
        <span style="background:pink"></span>
        <span style="background:green"></span>
      </div>
    </div>

        <!-- Dried Flowers -->
        <div class="catalog-item gray">
      <h3>Dried Flowers</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"><b>Small Dried Flowers</b> start from 250k</div>
          <img src="img/DriedFlowers1.png" alt="Dried Flowers 1">
          <div class="caption-bottom"></div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Medium Dried Flowers</b> start from 300k</div>
          <img src="img/DriedFlowers2.png" alt="Dried Flowers 2">
          <div class="caption-bottom"></div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Large Dried Flowers</b> start from 500k</div>
          <img src="img/DriedFlowers3.png" alt="Dried Flowers 3">
          <div class="caption-bottom"></div>
        </div>
      </div>
      <p>Rangkaian dengan bunga utama Bunga <b>Kering</b>, bisa dikombinasi dengan daun, filler, dan bunga lain. </p>
      <p>*Rangkaian bisa dibuat ke dalam vase, box, basket, dengan penambahan harga yang tercantum pada halaman <b>add on.</b></p>
      <div class="colors">
        <span style="background:rgb(0, 0, 0)"></span>
        <span style="background:rgb(238, 177, 87)"></span>
        <span style="background:rgb(226, 171, 51)"></span>
        <span style="background:white"></span>
        <span style="background:blue"></span>
      </div>
    </div>

        <!-- Blooming Canvas -->
    <div class="catalog-item gray">
      <h3>Blooming Canvas</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"></div>
          <img src="img/BloomingCanvas1.png" alt="Blooming Canvas 1">
          <div class="caption-bottom"></div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"></div>
          <img src="img/BloomingCanvas2.png" alt="Blooming Canvas 2">
          <div class="caption-bottom"></div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"></div>
          <img src="img/BloomingCanvas3.png" alt="Blooming Canvas 3">
          <div class="caption-bottom"></div>
        </div>
      </div>
      <p>Papan ucapan dengan rangkaian bunga artificial bernuansa elegan, cocok untuk momen</p>
      <P>pernikahan dan acara spesial lainnya. Menggunakan kombinasi bunga premium dengan warna</P>
      <p>lembut serta latar artistik yang modern.</p>
      <p><i>Tulisan dan warna dapat disesuaikan sesuai tema acara. Tersedia pilihan rangkaian dengan berbagai ukuran dan desain.</i></p>
    </div>
    
  <div class="orchid-center">
  <div class="catalog-item gray">
    <h3>Orchid On Vase</h3>
  </div>

    <div class="orchid-section">

        <!-- ORCHID 1 / 2 -->
        <div class="orchid-row">
          <div class="orchid-image">
            <img src="img/orchid21.png" alt="Orchid 1 or 2">
          </div>

          <div class="orchid-text">
            <h3>Orchid 1 or 2</h3>

            <div class="price-block">
              <h4>365 K</h4>
              <p>1 orchid plant<br>small ceramic vase<br>ornaments</p>
            </div>

            <div class="price-block">
              <h4>665 K</h4>
              <p>2 orchid plant<br>small ceramic vase<br>ornaments</p>
            </div>
          </div>
        </div>

        <!-- ORCHID 3 -->
        <div class="orchid-row">
          <div class="orchid-image">
            <img src="img/orchid22.png" alt="Orchid 3">
          </div>

          <div class="orchid-text">
            <h3>Orchid 3</h3>

            <div class="price-block">
              <h4>1.000 K</h4>
              <p>3 orchid plant<br>medium ceramic vase<br>ornaments</p>
            </div>
          </div>
        </div>

        <!-- ORCHID 5 / 6 -->
        <div class="orchid-row">
          <div class="orchid-image">
            <img src="img/orchid23.png" alt="Orchid 5 or 6">
          </div>

          <div class="orchid-text">
            <h3>Orchid 5 or 6</h3>

            <div class="price-block">
              <h4>1.600 K</h4>
              <p>5 orchid plant<br>large ceramic vase<br>ornaments</p>
            </div>

            <div class="price-block">
              <h4>1.900 K</h4>
              <p>6 orchid plant<br>large ceramic vase<br>ornaments</p>
            </div>
          </div>
        </div>

      </div>

      <div class="catalog-item gray">
        <h4 class="orchid-var-title">Variety</h4>
        <div class="orchid-variety">
          <img src="img/orchid-var1.png" alt="Var 1">
          <img src="img/orchid-var2.png" alt="Var 2">
          <img src="img/orchid-var3.png" alt="Var 3">
          <img src="img/orchid-var4.png" alt="Var 4">
          <img src="img/orchid-var5.png" alt="Var 5">
        </div>
      </div>
    </div>



    <div class="catalog-item gray">
      <h3>Orchid Forest</h3>

      <div class="catalog-content orchid-flex">
        <div class="orchid-card">
          <img src="img/orchid1.png" alt="Orchid 780K">
          <div class="orchid-price">780K</div>
        </div>

        <div class="orchid-card">
          <img src="img/orchid2.png" alt="Orchid 1.200K">
          <div class="orchid-price">1.200K</div>
        </div>
      </div>

      <p>
        Orchid plants in beautiful ceramic pot combined with ferns, wood, 
        and rocks to add accents.
      </p>

      <h4 style="margin-top: 1rem; font-style: italic;">Variety</h4>

      <div class="orchid-variety">
        <img src="img/orchid-var1.png" alt="Var 1">
        <img src="img/orchid-var2.png" alt="Var 2">
        <img src="img/orchid-var3.png" alt="Var 3">
        <img src="img/orchid-var4.png" alt="Var 4">
        <img src="img/orchid-var5.png" alt="Var 5">
      </div>
    </div>

    <!-- Real Plant -->
    <div class="catalog-item gray">
      <h3>Real Plant</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"><b>Small Real Plant</b> start from 250k</div>
          <img src="img/RealPlant1.png" alt="Real Plant 1">
          <div class="caption-bottom"></div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Medium Real Plant</b> start from 300k</div>
          <img src="img/RealPlant2.png" alt="Real Plant 2">
          <div class="caption-bottom"></div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Large Real Plant</b> start from 500k</div>
          <img src="img/RealPlant3.png" alt="Real Plant 3">
          <div class="caption-bottom"></div>
        </div>
      </div>
      <p>Rangkaian dengan bunga utama Bunga <b>Asli</b>, bisa dikombinasi dengan daun, filler, dan bunga lain. </p>
      <p>*Rangkaian bisa dibuat ke dalam vase, box, basket, dengan penambahan harga yang tercantum pada halaman <b>add on.</b></p>
      <div class="colors">
        <span style="background:white"></span>
        <span style="background:yellow"></span>
        <span style="background:red"></span>
        <span style="background:pink"></span>
      </div>
    </div>


  </section>

 <footer
  style="
    position:fixed;
    bottom:0;
    left:0;
    width:100%;
    background:#283128;
    color:#d9d9d9;
    text-align:center;
    padding:10px 10px;
    z-index:9999;
    font-size:14px;
  ">


  <!-- Address -->
  <div style="margin-bottom:6px;">
    Jalan Raya Golf Dago No. 4, Bandung
  </div>

  <!-- WA & IG sejajar -->
  <div style="display:flex; justify-content:center; gap:20px;">
    <a href="https://wa.me/6285795077194"
       target="_blank"
       style="color:#d9d9d9;">
       WhatsApp
    </a>

    <a href="https://www.instagram.com/ilmisgarden/"
       target="_blank"
       style="color:#d9d9d9;">
       Instagram
    </a>
  </div>

</footer>

    <!-- feather icons -->
    <script>
      feather.replace();
    </script>
    <!-- js -->
    <script src="js/script.js"></script>
</body>
</html>
