-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 02:54 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugasakhir`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `alternatif` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `alternatif`) VALUES
(4, 'Sehat'),
(5, 'Perlu Perhatian'),
(6, 'Butuh Penanganan');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `skrining_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `user_id`, `skrining_id`, `question_id`, `answer`) VALUES
(181, 59, 227, 59, '1'),
(182, 59, 227, 60, '1'),
(183, 59, 227, 61, '1'),
(184, 59, 227, 62, '1'),
(185, 59, 227, 63, '1'),
(186, 59, 227, 64, '1'),
(187, 59, 227, 65, '1'),
(188, 59, 227, 66, '1'),
(189, 59, 227, 67, '1'),
(190, 59, 227, 68, '1'),
(191, 59, 227, 69, '1'),
(192, 59, 227, 70, '1'),
(193, 59, 227, 72, '1'),
(194, 59, 227, 73, '1'),
(195, 59, 227, 74, '1'),
(196, 59, 227, 75, '1'),
(197, 59, 227, 76, '1'),
(198, 59, 227, 77, '1'),
(199, 59, 227, 78, '1'),
(200, 59, 227, 79, '1'),
(201, 62, 228, 59, '0'),
(202, 62, 228, 60, '0'),
(203, 62, 228, 61, '0'),
(204, 62, 228, 62, '0'),
(205, 62, 228, 63, '0'),
(206, 62, 228, 64, '0'),
(207, 62, 228, 65, '0'),
(208, 62, 228, 66, '0'),
(209, 62, 228, 67, '0'),
(210, 62, 228, 68, '0'),
(211, 62, 228, 69, '0'),
(212, 62, 228, 70, '0'),
(213, 62, 228, 72, '0'),
(214, 62, 228, 73, '0'),
(215, 62, 228, 74, '0'),
(216, 62, 228, 75, '0'),
(217, 62, 228, 76, '0'),
(218, 62, 228, 77, '0'),
(219, 62, 228, 78, '0'),
(220, 62, 228, 79, '0');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `image_path`, `created_at`, `updated_at`) VALUES
(62, 'Mengatasi Tantangan Kesehatan Mental Mahasiswa', '<p>Kesehatan mental telah menjadi isu penting yang patut mendapatkan perhatian khusus sejak satu dekade terakhir. Bukan hanya masalah kesehatan mental secara global yang membutuhkan penanganan intensif, melainkan juga tantangan kesehatan mental di kalangan mahasiswa. Gangguan kesehatan mental jelas berpengaruh terhadap kualitas Sumber Daya Manusia (SDM) Indonesia di masa depan.&nbsp;</p>\r\n\r\n<h2><strong>Penelitian tentang Kesehatan Mental Mahasiswa</strong></h2>\r\n\r\n<p>Platform media digital&nbsp;<em>The Conversation</em>&nbsp;melakukan kolaborasi dengan lembaga lainnya untuk melakukan penelitian kesehatan mental di tanah air pada Oktober 2022. Hasilnya, 1 dari 20 remaja Indonesia atau sekitar 2,45 juta jiwa pada rentang usia 10 hingga 19 tahun didiagnosis mengalami gangguan mental.&nbsp;</p>\r\n\r\n<p>Informasi lainnya yang dilansir dari situs Kemdikbud.go.id menyatakan bahwa kini gangguan mental kerap terjadi pada kelompok usia 18-25 tahun. Dengan kata lain, fenomena tersebut berkaitan erat dengan kalangan mahasiswa. Sebanyak 64% generasi muda mengalami masalah kecemasan, sedangkan 61,5% diantaranya sudah mengarah pada gejala depresi. Beberapa tanda gangguan kesehatan mental yang kerap dialami generasi muda, antara lain cemas berlebihan, kemampuan interaksi sosial terganggu, serta gangguan tidur dan selera makan.</p>\r\n\r\n<h3><strong>Mengenal Pentingnya Kesehatan Mental Bagi Mahasiswa&nbsp;</strong></h3>\r\n\r\n<p>Sebagai salah satu universitas dengan&nbsp;<a href=\"https://www.prasetiyamulya.ac.id/program/\">fakultas bisnis terbaik di Indonesia</a>, Prasetiya Mulya (Prasmul) tidak sekadar berfokus pada pengembangan kompetensi mahasiswa. Lebih dari itu, Prasmul turut berusaha mengatasi tantangan bagi kaum akademisi tersebut karena kondisi mental mahasiswa yang sehat akan mendatangkan beberapa manfaat berikut ini:&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Kondisi mental yang sehat membuat mahasiswa fokus belajar sehingga performa akademiknya cenderung baik.&nbsp;</li>\r\n	<li>Konsentrasi dan produktivitas meningkat selama beraktivitas di kampus maupun di luar kampus.&nbsp;</li>\r\n	<li>Relasi yang sehat dengan sesama mahasiswa, dosen, staf kampus, maupun orang-orang terdekat di lingkungan sekitar bisa terjalin baik.&nbsp;</li>\r\n	<li>Punya daya tahan yang baik ketika menghadapi tantangan dan lebih mudah beradaptasi terhadap lingkungan baru, khususnya ketika memasuki dunia kerja.&nbsp;</li>\r\n</ul>\r\n\r\n<h3><strong>Tips agar Mahasiswa Dapat Menjaga Kesehatan Mental di Kampus&nbsp;</strong></h3>\r\n\r\n<p>Prasmul merekomendasikan beberapa tips efektif berikut ini agar kesehatan mental mahasiswa (Prasmulyan) terjaga dengan baik:&nbsp;</p>\r\n\r\n<ol>\r\n	<li><strong>Belajar mengelola waktu secara efektif</strong><br />\r\n	Manajemen waktu adalah salah satu kemampuan penting untuk menjaga kestabilan mental mahasiswa. Jangan biarkan kesibukan kampus yang berlebih malah menimbulkan stres. Berusahalah membagi waktu untuk kegiatan kampus, penyelesaian tugas, serta kegiatan lainnya di luar akademik. Menikmati waktu bersenang- senang di luar aktivitas kuliah tentu sama pentingnya dengan pencapaian prestasi di kampus.&nbsp;</li>\r\n</ol>\r\n\r\n<ol>\r\n	<li><strong>Jaga kesehatan fisik</strong><br />\r\n	Jangan lupa bahwa kesehatan fisik juga erat kaitannya dengan kesehatan mental. Kondisi fisik yang kurang prima membuat Prasmulyan jadi rentan lelah hingga akhirnya mengalami stres. Oleh sebab itu, Prasmulyan patut menjalani pola hidup sehat secara konsisten untuk menjaga kesehatan fisik. Konsumsi makanan bergizi, olahraga rutin, dan istirahat cukup akan membuat Prasmulyan lebih berenergi sehingga kondisi mental pun jadi stabil dan siap menghadapi berbagai tantangan.&nbsp;</li>\r\n</ol>\r\n\r\n<ol>\r\n	<li><strong>Bersosialisasi dan menjalin relasi melalui himpunan mahasiswa</strong><br />\r\n	Reputasi sebagai kampus dengan&nbsp;<a href=\"https://www.prasetiyamulya.ac.id/program/\">jurusan manajemen bisnis terbaik di Indonesia</a>&nbsp;tidak lantas membuat Prasmul mudah puas. Hingga saat ini Prasmul masih terus berupaya melakukan berbagai inovasi yang berorientasi pada kepentingan mahasiswa, salah satunya melalui keberadaan berbagai himpunan mahasiswa. Kehadiran himpunan tersebut menjadi wadah yang tepat bagi mahasiswa untuk bersosialisasi, menjalin relasi dengan banyak kenalan baru, serta mewujudkan ide dengan cara yang positif.&nbsp;</li>\r\n</ol>\r\n\r\n<ol>\r\n	<li><strong>Lakukan konseling bila membutuhkan</strong><br />\r\n	Prasmul juga menyediakan fasilitas&nbsp;<a href=\"https://www.prasetiyamulya.ac.id/konseling/\">konseling</a>&nbsp;yang memungkinkan mahasiswa melakukan konsultasi non akademik. Sesi konseling tersebut diharapkan bisa membantu mengatasi persoalan pribadi maupun interaksi sosial yang berpengaruh terhadap proses belajar. Klasifikasi layanan konseling Prasmul meliputi bimbingan rujukan, bimbingan kelompok, walk in konseling, serta online counseling. Selain konseling, mahasiswa juga patut menetapkan ekspektasi dan mengatur target pribadi secara realistis supaya tujuan tersebut mudah dicapai.&nbsp;</li>\r\n</ol>\r\n\r\n<ol>\r\n	<li><strong>Luangkan me time agar lebih rileks</strong><br />\r\n	Kesehatan mental berhubungan pula dengan waktu yang cukup bagi diri sendiri. Jadi, alangkah lebih baik jika Prasmulyan senantiasa meluangkan me time secara teratur supaya lebih rileks dan terhindar dari stres. Memanfaatkan me time untuk menekuni hobi atau kegiatan santai lainnya yang menyenangkan.&nbsp;</li>\r\n</ol>\r\n\r\n<p>Kestabilan mental mahasiswa yang terjaga adalah modal utama untuk meningkatkan kualitas generasi muda di tanah air. Semoga upaya Prasmul dalam mendukung kesehatan mental Prasmulyan menginspirasi berbagai pihak lain untuk melakukan hal serupa.<br />\r\n<br />\r\nSumber :&nbsp;https://www.prasetiyamulya.ac.id/mengatasi-tantangan-kesehatan-mental-mahasiswa/</p>\r\n', '../uploads/Mengatasi-Tantangan-Kesehatan-Mental-Mahasiswa-Universitas-Prasetiya-Mulya (1).jpg', '2024-01-24 03:24:39', '2024-03-07 08:03:07'),
(63, 'Mental Health Mahasiswa', '<p><em>Pentingnya Mengenal dan Memahami kesehatan Mental?</em></p>\r\n\r\n<p>(<strong>UINSGD.AC.ID</strong>)-Perubahan-perubahan social yang serba cepat sebagai konsekuensi modernisasi, industrialisasi, kemajuan ilmu, pengetahuan dan teknologi, mempunyai dampak pada kehidupan masyarakat. Perubahan-perubahan social tersebut telah mempengaruhi nilai kehidupan masyarakat. Tidak semua orang mampu menyesuaikan diri dengan perubahan-perubahan tersebut, yang pada gilirannya dapat menimbulkan ketegangan atau stress pada dirinya. Selain itu, dengan adanya wabah pandemic covid-19 memicu kesehatan mental masyarakat menjadi tidak menentu.</p>\r\n\r\n<p>Hal tersebut di atas adalah beberapa hal yang dapat merupakan sumber stress psikososial dalam masyarakat, yang pada gilirannya taraf kesehatan yang bersangkutan akan terganggu karenanya. Taraf kesehatan yang dimaksudkan disini adalah tidak semata-mata sehat dalam arti fisik, tetapi juga dalam arti mental, social, dan spiritual (WHO, 1984).</p>\r\n\r\n<p>Prof. T.A Lambo, direktur kesehatan jiwa WHO di dalam (9 th Word Congress of Social Psychiatry di Paris, 1982, mengutarakan bahwa kemajuan ilmu pengetahuan, teknologi dan modernisasi merupakan factor social ekonomi baru dalam bidang kesehatan. Kini masalah kesehatan tidak lagi hanya menyangkut beberapa angka kematian (mortalitas) atau angka kesakitan/penyakit (morbiditas), melainkan mencakup ruang lingkup kehidupan yang lebih luas, yaitu berbagai factor psikososial yang dapat dan merupakan stress kehidupan anggota masyarakat.</p>\r\n\r\n<p>Terdapat keadaan mental yang secara khusus perlu mendapat perhatian, yaitu &ldquo;sehat mental&rdquo;, &ldquo;mental tak sehat&rdquo; dan &ldquo;sakit mental&rdquo;.</p>\r\n\r\n<p>Sehat mental secara umum dapat diartikan sebagai kondisi mental yang tumbuh dan didasari motivasi yang kuat ingin meraih kualitas diri yang lebih baik, baik dalam kehidupan keluarga, kehidupan kerja, maupun sisi kehidupan lainnya.</p>\r\n\r\n<p>Mental tidak sehat ialah orang yang meskipun secara potensial memiliki kemampuan, tetapi tidak punya keinginan dan usaha untuk mengaktualisasikan potensinya itu secara optimal.</p>\r\n\r\n<p>Sakit mental adalah orang yang secara mental memiliki berbagai macam unsure yang saling bertentangan dan dengan demikian, sering merusak atau menghambat, sehingga perilakunya tidak menentu.</p>\r\n\r\n<p><em>Bagaimana Adaptasi Mahasiswa baru di Dunia Perkuliahan?</em></p>\r\n\r\n<p>Seorang mahasiswa dikategorikan pada tahap perkembangan yang usianya antara 18 sampai 25 tahun. Tahap ini dapat digolongkan pada masa remaja akhir sampai masa dewasa awal dan dilihat dari segi perkembangan, tugas perkembangan pada usia mahasiswa ini ialah pemantapan pendirian hidup.</p>\r\n\r\n<p>Mahasiswa dinilai memiliki tingkat intelektualitas yang tinggi, kecerdasan dalam berpikir dan kerencanaan dalam bertindak. Berpikir kritis dan bertindak dengan cepat dan tepat merupakan sifat yang cenderung melekat pada diri setiap mahasiswa, yang merupakan prinsip yang saling melengkapi.<br />\r\nMenurut Susantoro mahasiswa adalah merupakan kalangan muda yang berumur antara 19 sampai 28 tahun yang memang dalam usia tersebut mengalami suatu peralihan dari tahap remaja ke tahap dewasa.</p>\r\n\r\n<p><em>Karakteristik Mahasiswa?</em></p>\r\n\r\n<p>1. Stabilitas dalam kepribadian yang mulai meningkat, karena berkurangnya gejolak-gejolak yang ada didalam perasaan.<br />\r\n2. Mulai memantapkan dan berpikir dengan matang terhadap sesuatu yang akan diraihnya, sehingga mereka memiliki pandangan yang realistik tentang diri sendiri dan lingkungannya.<br />\r\n3. Mahasiswa akan cenderung lebih dekat dengan teman sebaya untuk saling bertukar pikiran dan saling memberikan dukungan, karena dapat kita ketahui bahwa sebagian besar mahasiswa berada jauh dari orang tua maupun keluarga.<br />\r\n4. Karakteristik mahasiswa yang paling menonjol adalah mereka mandiri, dan memiliki prakiraan di masa depan, baik dalam hal karir maupun hubungan percintaan. Mereka akan memperdalam keahlian dibidangnya masing-masing untuk mempersiapkan diri menghadapi dunia kerja yang membutuhkan mental tinggi.</p>\r\n\r\n<p><em>Bagaimana Mahasiswa Harus Beradaptasi dengan Situasi yang Baru?</em></p>\r\n\r\n<p>&ndash; Budaya Kampus<br />\r\n&ndash; Metode Pembelajaran<br />\r\n&ndash; Media Pembelajaran<br />\r\n&ndash; Pengajar / Dosen<br />\r\n&ndash; KRS-an</p>\r\n\r\n<p><em>Penyebab salah jurusan?</em></p>\r\n\r\n<p>1. Tidak ditelusuri dulu minat bakal.<br />\r\n2. Ikut-ikutan teman.<br />\r\n3. Masuk karena pilihan yang kedua, tapi tidak sesuai harapan.<br />\r\n4. Kurang mendaptkan informasi terkait jurusan yang dipilih.<br />\r\n5. Asal kuliah saja.<br />\r\n6. Ikut ramenya sekarang jurusan apa yang diminati.<br />\r\n7. Karena paksaan orang tua.</p>\r\n\r\n<p><em>Aapa yang harus dilakukan?</em></p>\r\n\r\n<p>1. Koordinasikan dengan pembimbing akademik komunikasikan kesulitan yang dihadapi<br />\r\n2. Untuk memastikan minat bakat, lakukan psikotest minat bakat agar lebih terarah<br />\r\n3. Jika dirasakan tidak bisa menjalani sebaiknya pindah jurusan<br />\r\n4. Komunikasikan dengan orang tua<br />\r\n5. Deteksi sejak dini kesulitan kesulitan perkuliahan.<br />\r\n<br />\r\nSumber :&nbsp;https://uinsgd.ac.id/mental-health-mahasiswa/</p>\r\n', '../uploads/89aa8f2a.jpg', '2024-01-25 14:15:09', '2024-01-25 14:24:16'),
(64, 'Pentingnya Menjaga Kesehatan Mental Bagi Mahasiswa', '<p>Organisasi Kesehatan Dunia (WHO) mengungkapkan bahwa 1 miliar orang di dunia hidup dengan gangguan mental. Menurut rilis WHO dalam rangka peringatan Hari Kesehatan Mental Sedunia tahun 2020 pada tanggal 10 Oktober menyatakan bahwa 3 juta orang meninggal setiap tahunnya akibat penggunaan alkohol dan setiap 40 detik satu orang meninggal karena bunuh diri. WHO mencatat negara dengan penghasilan rendah dan menengah, lebih dari 75 persen orang dengan gangguan mental, neurologis dan penyalahgunaan zat tidak menerima pengobatan yang sesuai kondisi mereka.</p>\r\n\r\n<p>Situasi pandemik covid-19 saat ini, membuat pembahasan tentang kesehatan mental menjadi perbincangan menarik. Dengan segala perubahan yang terjadi karena pandemi virus corona, masyarakat dunia perlu menyesuaikan diri. Kesehatan mental mengacu pada kesejahteraan kognitif, perilaku, dan emosional. Hal inilah yang mengatur bagaimana cara orang berpikir, merasakan, dan berperilaku. Selain itu, kesehatan mental juga dapat memengaruhi kehidupan sehari-hari, hubungan atau relasi, dan kesehatan fisik.</p>\r\n\r\n<p>Data terbaru yang dirilis oleh WHO saat pandemi corona, menunjukkan adanya penambahan kasus gangguan kesehatan mental secara signifikan di sejumlah negara. Menurut data dari situs resmi WHO, mereka melakukan survei di 130 negara. Hasilnya, ada dampak buruk Covid-19 pada akses layanan kesehatan mental. Hasil survei WHO menyatakan lebih dari 60% melaporkan gangguan layanan kesehatan mental bagi orang-orang yang rentan, termasuk anak-anak dan remaja (70%); orang dewasa yang lebih tua (70%), dan wanita yang membutuhkan layanan antenatal atau postnatal (61%). Sebanyak 67% melihat gangguan pada konseling dan psikoterapi; 65% untuk layanan pengurangan bahaya kritis; dan 45% untuk pengobatan pemeliharaan agonis opioid untuk ketergantungan opioid. Lebih dari sepertiga (30%) melaporkan gangguan pada intervensi darurat, termasuk orang yang mengalami kejang berkepanjangan, sindrom penarikan penggunaan zat yang parah, dan delirium, seringkali merupakan tanda kondisi medis serius yang mendasari. Ada 30% negara yang melaporkan gangguan akses pengobatan untuk gangguan mental, neurologis dan penggunaan zat. Sekitar 75% negara melaporkan setidaknya sebagian gangguan terjadi di sekolah (78%), dan tempat kerja layanan kesehatan mental (75%).</p>\r\n\r\n<p>Beberapa bulan ke belakang, kesadaran masyarakat Indonesia dalam isu kesehatan mental dinilai terus meningkat. Di Indonesia, Data Riset Kesehatan Dasar (Riskesdas) 2013 memunjukkan prevalensi ganggunan mental emosional yang ditunjukkan dengan gejala-gejala depresi dan kecemasan untuk usia 15 tahun ke atas mencapai sekitar 14 juta orang atau 6% dari jumlah penduduk Indonesia. Sedangkan prevalensi gangguan jiwa berat, seperti skizofrenia mencapai sekitar 400.000 orang atau sebanyak 1,7 per 1.000 penduduk. Sementara data Riset Kesehatan Dasar yang dilakukan Kementerian Kesehatan pada 2018 menemukan bahwa prevalensi orang gangguan jiwa berat (skizofrenia/psikosis) meningkat dari 0,15% menjadi 0,18%, sementara prevalensi gangguan mental emosional pada penduduk usia 15 tahun keatas meningkat dari 6,1% pada tahun 2013 menjadi 9,8 persen pada 2018. Sementara itu prevalensi gangguan mental emosional pada remaja berumur &gt;15 tahun sebesar 9,8%. Angka jni meningkat dibandingkan tahun 2013 yaitu sebesar 6%.</p>\r\n\r\n<p>Masalah kesehatan mental di Indonesia pada masa ini masih tergolong sangat tinggi, terutama pada kalangan remaja karena mereka masih memiliki emosi yang tidak stabil dan belum memiliki kemampuan yang baik untuk memecahkan masalah yang ada. Masa remaja merupakan masa dimana mereka sering mengalami stres terutama pada peristiwa-peristiwa tertentu dalam hidup mereka. Remaja dianggap sebagai golongan yang rentan untuk mengalami gangguan mental. Oleh karena itu, remaja perlu untuk mendapatkan perhatian lebih karena remaja merupakan aset negara dan generasi penerus bangsa.</p>\r\n\r\n<p>Kesehatan mental pada mahasiswa dapat dipengaruhi oleh beberapa faktor, diantaranya yaitu faktor genetika, keluarga, pertemanan, gaya hidup, sosial, dan berbagai faktor lainnya. Faktor-faktor tersebut dapat mempengaruhi mahasiswa secara positif maupun negatif. Akan tetapi, masih banyak mahasiswa yang tidak menyadari dampak positif dan negatif yang ditimbulkan dari faktor-faktor tersebut sehingga mereka lupa akan kesehatan mental mereka. Mereka lupa untuk berfokus pada kesehatan mental mereka karena mereka hanya berfokus pada tugas, organisasi, jadwal kuliah, serta tuntutan-tuntutan yang ia terima dari orang-orang di sekitarnya. Regulasi diri dalam belajar yang baik akan membantu mahasiswa untuk memenuhi tuntutan-tuntutan yang dihadapinya. Regulasi diri adalah kemampuan seseorang untuk melakukan kontrol terhadap emosi dan perilakunya di situasi apapun secara mandiri.</p>\r\n\r\n<p>Pada awal masa COVID-19, pemerintah resmi menyatakan bahwa semua instansi pendidikan akan melaksanakan pembelajaran secara daring (media dalam jaringan) pada bulan Maret 2020. Berawal dari kuliah daring, kita dapat melihat bagaimana dampak yang ditimbulkan terhadap para mahasiswa melalui kuliah daring tersebut, terutama pada mahasiswa baru. Seharusnya, masa perkuliahan awal merupakan kesempatan bagi mahasiwa baru untuk mencari relasi, mengembangkan diri, serta belajar untuk menjadi lebih mandiri. Akan tetapi, sekarang hal itu menjadi lebih sulit untuk dilakukan karena ketidakmampuan mahasiswa untuk berinteraksi secara langsung sehingga hal-hal yang seharusnya menjadi kesempatan emas bagi mahasiswa baru pun hilang.</p>\r\n\r\n<p>Kesehatan mental memiliki peranan yang sangat penting bagi mahasiswa baru untuk beradaptasi dengan lingkungan perkuliahannya yang baru. Tentunya kehidupan di lingkungan kampus dan sekolah jauh berbeda. Mahasiswa baru akan menemukan berbagai macam pergaulan yang sangat beragam serta akan menemukan metode pembelajaran yang berbeda dibanding masa sekolah. Oleh karena itu, secara tidak langsung mahasiswa baru dituntut untuk bisa beradaptasi terhadap lingkungan barunya. Selain mahasiswa baru, mahasiswa lama pun mengalami beberapa dampak yang diakibatkan oleh kuliah daring, terutama bagi mahasiswa yang mengikuti organisasi. Dengan adanya kuliah daring, maka secara otomatis tugas-tugas perkuliahan pun akan semakin banyak.</p>\r\n\r\n<p>Menurut paparan dari WHO pada tahun 2019, belakangan ini stress lebih sering muncul terjadi karena beberapa hal sebagai berikut,</p>\r\n\r\n<ol>\r\n	<li>Ketakutan dan kecemasan mengenai kesehatan diri maupun kesehatan orang lain yang disayangi</li>\r\n	<li>Perubahan pola tidur dan pola makan</li>\r\n	<li>Sulit tidur dan konsentrasi</li>\r\n	<li>Menggunakan obat-obatan</li>\r\n</ol>\r\n\r\n<p>Hal ini juga serupa dengan penyebab dari perubahan kesehatan mental pada kalangan Mahasiswa di Indonesia. Ironinya hal ini acap kali terjadi dan dianggap lazim di masyarakat. Sebagaimana kita mengetahui dampak yang diberikan oleh perubahan kesehatan mental yang sangat patut diwaspadai. Maka dari itu berikut tips dan trik yang bisa dilakukan teman-teman Mahasiswa di rumah.</p>\r\n\r\n<ol>\r\n	<li><strong>Pendekatan spiritual</strong>, ketahui hal mana saja yang dapat kita kendalikan dan tidak dapat kita kendalikan. Dengan mengetahui hal tersebut dan selalu bersandar kepada Sang Maha Kuasa membuat hati lebih tenang</li>\r\n	<li><strong>Olahraga teratur</strong>, usahakan untuk melakukan olahraga tiap harinya sesuai dengan kebutuhan tubuh masing masing. Berolahraga terbukti menurunkan jumlah hormon kortisol yang menjadi pemicu stress dalam tubuh</li>\r\n	<li><strong>Selalu terhubung dengan&nbsp;</strong><strong><em>social support,&nbsp;</em></strong>tiap kali ada persoalan atau tidak tetap rutin hubungi keluarga sekaligus bila rasa dukungan sosial belum mampu teratasi, jangan ragu untuk menghubungi bantuan tenaga profesional</li>\r\n</ol>\r\n\r\n<p>Penting bagi kita semua untuk sama sama menjadi Mahasiswa yang tangguh dan sehat mental. Saatnya satu sama lain saling peduli dan meningkatkan rasa empati. Dengan beberapa cara di atas besar harapannya bisa membantu untuk tetap menjaga kondisi kesehatan mental Mahasiswa.</p>\r\n\r\n<p>Sumber :&nbsp;https://gc.ukm.ugm.ac.id/2021/05/pentingnya-menjaga-kesehatan-mental-bagi-mahasiswa/</p>\r\n', '../uploads/HIV-AIDS-Vaccine-One-Step-Further-to-Cure-theIncurable-300x300.png', '2024-01-25 14:25:02', '2024-01-25 14:25:33'),
(65, 'Menjadi Isu Global, Ini Pentingnya Kesehatan Mental Mahasiswa dan Pelajar', '<p>Agar bisa menempuh pendidikan dengan lancar dan fokus belajar, seluruh pelajar harus dalam keadaan yang sehat baik secara fisik maupun mental. Kesehatan mental para pelajar adalah salah satu hal penting yang harus dijaga agar jalan mereka mewujudkan mimpi tidak terhambat. Namun nyatanya banyak sekali pelajar dari segala usia mengalami tekanan pada kesehatan mental mereka. Terutama para mahasiswa internasional yang terjadi pada beberapa kasus dari berbagai negara. Sebenarnya seperti apa sih kesehatan mental itu alias&nbsp;<em>mental health</em>? Dan apa yang harus dilakukan agar kesehatan mental para pelajar dan mahasiswa bisa terjaga dengan baik?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Tentang Kesehatan Mental Pelajar dan Mahasiswa</strong></p>\r\n\r\n<p>Menurut Organisasi Kesehatan Dunia (WHO), kesehatan mental adalah keadaan sejahtera di mana setiap individu bisa mewujudkan potensi mereka sendiri. Artinya, mereka dapat mengatasi tekanan kehidupan yang normal, dapat berfungsi secara produktif dan bermanfaat, serta mampu memberikan kontribusi kepada komunitas mereka. Namun nyatanya sering terjadi peristiwa yang kemudian berdampak pada rasa trauma akibat kekerasan, tekanan berlebih, ataupun stress dalam jangka panjang.</p>\r\n\r\n<p>Jika kesehatan mental terganggu, maka timbul gangguan mental atau penyakit mental. Gangguan mental dapat mengubah cara seseorang dalam menangani stres, berinteraksi dengan orang lain, membuat pilihan, dan memicu hasrat untuk menyakiti diri sendiri. Jika dibiarkan tentu hal ini akan sangat membahayakan apalagi di kalangan para pelajar dan mahasiswa yang seharusnya bisa mengenyam pendidikan dengan akal yang sehat demi masa depan yang lebih baik.&nbsp;</p>\r\n\r\n<p>Berdasarkan penelitian internasional, isu kesehatan mental mahasiswa maupun siswa kini menjadi masalah utama di beberapa negara. Hal ini terjadi karena memang gangguan ini bisa menyerang siapa saja apapun latar belakangnya. Catatan&nbsp;<em>Mozaic Science</em>&nbsp;melalui&nbsp;<em>World Economic Forum (WEF)</em>&nbsp;menyebutkan jumlah mahasiswa di Inggris yang mengunjungi bagian konseling kampus meningkat hampir lima kali dibandingkan 10 tahun lalu. Begitu juga di Amerika Serikat, depresi dan kecemasan dikalangan anak dibawah 17 tahun jadi bermunculan. Sedangkan untuk usia mahasiswa, permintaan konseling jadi meningkat. Mahasiswa memang rentan terkena masalah kesehatan mental karena harus bergulat dengan lingkungan sosial baru, menghadapi tuntutan untuk meniti karier, hingga problem keuangan.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Di Indonesia sendiri masalah kesehatan mental pelajar menjadi perhatian lebih sejak pandemi Covid 19 terjadi. Sejak diharuskannya Pembelajaran Jarak jauh, tercatat kasus kecemasan dan kesehatan mental pelajar dan mahasiswa meningkat menjadi 63,6% akibat pandemi.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Tips Menjaga Kesehatan Mental Pelajar</strong></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Olahraga Teratur</strong></p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Biasanya saat seseorang mengalami kecemasan dan masalah pada kesehatan mental, muncul pikiran negatif yang mengganggu. Untuk menekan itu semua kamu bisa mengalihkan perhatian kamu dengan berolahraga. Dengan berolahraga makan hormon endorfin yang akan menekan laju hormon kortisol penyebab stress.</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Lakukan Hobi</strong></p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Dengan melakukan ini, kamu bisa lebih meningkatkan mood atau suasana hatimu karena memang hobi tersebut adalah hal yang kamu sukai. Rasa pressure yang kamu hadapi juga bisa berkurang dan terganti dengan perasaan yang lebih positif.</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Mencari Support Sistem</strong></p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Untuk memperkuat kesehatan mental dalam jangka panjang, kamu bisa bergabung dengan komunitas-komunitas terntentu yang memberikan dukungan pada mahasiswa yang mengalami depresi dan stress. Dengan menjalin hubungan positif dengan lingkungan yang tepat, kamu jadi merasa tak sendiri menghadapi masalah yang kamu alami.</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Mencari Bantuan Profesional</strong></p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Jika masalah kesehatan mental terlanjur menyerang mu, jangan berusaha untuk menyangkalnya. Segeralah mencari bantuan profesional seperti bagian konseling di universitas atau psikolog. Jangan menyimpulkan diagnosa sendiri ya, karena akan berdampak semakin parah terhadap kesehatan mental kamu.</p>\r\n\r\n<p>Bagaimana jika kamu mendapati teman mu mengalami masalah kesehatan mental? Kamu bisa mendampinginya untuk mencari bantuan profesional. Dengan tidak menyudutkan dan memaksa lebih jauh, dukungan yang tulus dari orang terdekatlah yang bisa menyelamatkan mereka dari tindakan yang merugikan masa depannya.<br />\r\n<br />\r\nSumber :&nbsp;https://www.hotcourses.co.id/study-abroad-info/student-life/ini-pentingnya-kesehatan-mental-mahasiswa-dan/</p>\r\n', '../uploads/kemenkes-mesti-ikut-andil-atasi-siswa-depresi-karena-pjj-tji3ymmNpv.jpg', '2024-01-25 14:28:34', '2024-01-25 14:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `website` varchar(100) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `maps` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `address`, `phone`, `website`, `image_path`, `maps`, `created_at`, `updated_at`) VALUES
(42, 'Rumah Sakit Umum Daerah Dr. Soetomo', 'Jl. Prof. DR. Moestopo No.6-8, Airlangga, Kec. Gubeng, Surabaya, Jawa Timur 60286', '0315501078', 'https://rsudrsoetomo.jatimprov.go.id/', '../uploads/Cuplikan layar 2024-03-07 141644.png', 'https://maps.app.goo.gl/Fj2e7ob8oayXSgu96', '2024-01-25 13:44:49', '2024-03-07 07:17:03'),
(43, 'RS Premier Surabaya', 'Jl. Nginden Intan Barat No.Blok B, Nginden Jangkungan, Kec. Sukolilo, Surabaya, Jawa Timur 60118', '0315993211', 'https://www.ramsaysimedarby.co.id/rs-premier-surabaya/', '../uploads/Cuplikan layar 2024-03-07 142309.png', 'https://maps.app.goo.gl/fYahAB7yppiLgyoT9', '2024-01-25 13:57:36', '2024-03-07 08:14:05'),
(44, 'Rumah Sakit Umum Daerah (RSUD) dr. Moewardi', 'Jl. Kolonel Sutarto No.132, Jebres, Kec. Jebres, Kota Surakarta, Jawa Tengah 57126', '0271634634', 'https://rsmoewardi.com/', '../uploads/Cuplikan layar 2024-03-07 142038.png', 'https://maps.app.goo.gl/3aEFRJAPf9o9HA4u6', '2024-01-25 14:00:32', '2024-03-07 07:20:45'),
(45, 'RS Bhayangkara Surabaya', 'Jl. Ahmad Yani No.116, Ketintang, Kec. Gayungan, Surabaya, Jawa Timur 60231', '0318292227', 'http://rs-bhayangkarasurabaya.id/', '../uploads/Cuplikan layar 2024-03-07 141838.png', 'https://maps.app.goo.gl/o4h9ULJdEQvnNwe48', '2024-01-25 14:20:42', '2024-03-07 08:14:00'),
(46, 'RS Husada Utama', 'Jl. Prof. DR. Moestopo No.31-35, Pacar Keling, Kec. Tambaksari, Surabaya, Jawa Timur 60131', '0315018335', 'https://www.husadautamahospital.com/', '../uploads/Cuplikan layar 2024-03-07 142434.png', 'https://maps.app.goo.gl/fAgfUkZBswrQ1yRH7', '2024-03-07 07:26:50', '2024-03-07 07:26:50'),
(47, 'Rumah Sakit Umum Siloam Surabaya', 'Jl. Raya Gubeng No.70, Gubeng, Kec. Gubeng, Surabaya, Jawa Timur 60281', '03199206900', 'http://www.siloamhospitals.com/', '../uploads/Cuplikan layar 2024-03-07 142811.png', 'https://maps.app.goo.gl/pgL4peeDVEkdDaaZA', '2024-03-07 07:31:32', '2024-03-07 07:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `perbandingan_kriteria`
--

CREATE TABLE `perbandingan_kriteria` (
  `id` int(11) NOT NULL,
  `kriteria1` varchar(255) NOT NULL,
  `kriteria2` varchar(255) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perbandingan_kriteria`
--

INSERT INTO `perbandingan_kriteria` (`id`, `kriteria1`, `kriteria2`, `nilai`) VALUES
(1, 'Gejala Kognitif', 'Gejala Kognitif', 1),
(2, 'Gejala Kognitif', 'Gejala Kognitif', 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id_soal` int(11) NOT NULL,
  `nilai_a` int(11) NOT NULL,
  `nilai_b` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `question_group` int(11) NOT NULL,
  `subkriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id_soal`, `nilai_a`, `nilai_b`, `question_text`, `created_at`, `updated_at`, `question_group`, `subkriteria`) VALUES
(59, 1, 0, 'Apakah Anda merasa sulit berkonsentrasi atau mengingat hal-hal penting?', '2024-03-13 15:52:17', '2024-03-15 16:25:50', 1, 40),
(60, 1, 0, 'Apakah Anda sering lupa apa yang baru saja Anda lakukan atau katakan?', '2024-03-13 15:52:35', '2024-03-13 15:52:35', 1, 41),
(61, 1, 0, 'Apakah Anda merasa sulit membuat keputusan atau menyelesaikan masalah?', '2024-03-13 15:53:36', '2024-03-13 15:53:36', 1, 42),
(62, 1, 0, 'Apakah Anda merasa sulit untuk mengikuti instruksi atau menyelesaikan tugas?', '2024-03-13 15:53:59', '2024-03-13 15:53:59', 1, 40),
(63, 1, 0, 'Apakah Anda sering merasa tegang, gelisah, atau gugup?', '2024-03-13 15:54:26', '2024-03-13 15:54:26', 2, 43),
(64, 1, 0, 'Apakah Anda mudah tersinggung atau marah-marah tanpa sebab?', '2024-03-13 15:54:48', '2024-03-13 15:54:48', 2, 43),
(65, 1, 0, 'Apakah Anda sering merasa takut atau cemas tanpa alasan yang jelas?', '2024-03-13 15:55:06', '2024-03-13 15:55:06', 2, 43),
(66, 1, 0, 'Apakah Anda merasa tidak berdaya atau tidak berguna?', '2024-03-13 15:55:55', '2024-03-13 15:55:55', 2, 44),
(67, 1, 0, 'Apakah Anda merasa sedih atau murung sebagian besar waktu?', '2024-03-13 15:56:14', '2024-03-13 15:56:14', 2, 44),
(68, 1, 0, 'Apakah Anda merasa tidak bahagia atau tidak puas dengan hidup Anda?', '2024-03-13 15:56:31', '2024-03-13 15:56:31', 2, 44),
(69, 1, 0, 'Apakah Anda merasa tidak disukai atau ditolak oleh orang lain?', '2024-03-13 15:56:48', '2024-03-13 15:56:48', 2, 44),
(70, 1, 0, 'Apakah Anda sering merasa sulit tidur atau tidur terlalu banyak?', '2024-03-13 15:57:07', '2024-03-13 15:57:07', 2, 45),
(72, 1, 0, 'Apakah Anda sering merasa sakit kepala?', '2024-03-13 15:57:47', '2024-03-13 15:57:47', 3, 46),
(73, 1, 0, 'Apakah Anda sering merasa mual, muntah, atau diare?', '2024-03-13 15:58:12', '2024-03-13 15:58:12', 3, 47),
(74, 1, 0, 'Apakah Anda sering merasa sesak napas?', '2024-03-13 15:58:30', '2024-03-13 15:58:30', 3, 48),
(75, 1, 0, 'Apakah Anda sering merasa pusing atau pandangan kabur?', '2024-03-13 15:58:46', '2024-03-13 15:58:46', 3, 48),
(76, 1, 0, 'Apakah Anda sering merasa jantung berdebar-debar?', '2024-03-13 15:59:09', '2024-03-13 15:59:09', 3, 48),
(77, 1, 0, 'Apakah Anda merasa tidak bersemangat atau tidak tertarik dengan apa pun?', '2024-03-13 15:59:31', '2024-03-13 15:59:31', 4, 50),
(78, 1, 0, 'Apakah Anda sering merasa kesemutan, mati rasa, atau nyeri pada tangan atau kaki Anda?', '2024-03-13 15:59:47', '2024-03-13 15:59:47', 4, 51),
(79, 1, 0, 'Apakah Anda sering merasa lelah atau tidak bertenaga?', '2024-03-13 15:57:30', '2024-03-13 16:03:39', 4, 49);

-- --------------------------------------------------------

--
-- Table structure for table `skrining`
--

CREATE TABLE `skrining` (
  `id` int(11) NOT NULL,
  `hasil` varchar(100) NOT NULL,
  `nilai` int(11) NOT NULL,
  `waktu` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `timer` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skrining`
--

INSERT INTO `skrining` (`id`, `hasil`, `nilai`, `waktu`, `user_id`, `timer`) VALUES
(227, 'Butuh Penanganan', 20, '2024-03-17', 59, '00:00:14'),
(228, 'Sehat', 0, '2024-03-17', 62, '00:00:16');

-- --------------------------------------------------------

--
-- Table structure for table `soal_group`
--

CREATE TABLE `soal_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soal_group`
--

INSERT INTO `soal_group` (`id`, `name`) VALUES
(1, 'Gejala Kognitif'),
(2, 'Gejala Depresi'),
(3, 'Gejala Somatik'),
(4, 'Gejala Penurunan Energi');

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `subkriteria` text NOT NULL,
  `kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `subkriteria`, `kriteria`) VALUES
(40, 'Kesulitan Konsentrasi', 1),
(41, 'Kehilangan Daya Ingat', 1),
(42, 'Kesulitan dalam Pengambilan Keputusan', 1),
(43, 'Perasaan Gelisah', 2),
(44, 'Perasaan Sedih yang Berkepanjangan', 2),
(45, 'Gangguan Tidur', 2),
(46, 'Sakit Kepala', 3),
(47, 'Gangguan Pencernaan', 3),
(48, 'Nyeri Tubuh', 3),
(49, 'Kelelahan yang Berkelanjutan', 4),
(50, 'Kurangnya Motivasi', 4),
(51, 'Kurangnya Energi untuk Aktivitas Sehari-hari', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Namalengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `angkatan` int(11) NOT NULL,
  `gender` enum('Laki-Laki','Perempuan') NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Namalengkap`, `email`, `password`, `phoneNumber`, `angkatan`, `gender`, `role`, `created_at`, `updated_at`, `profile_image`) VALUES
(48, 'Shabian Arsyl Yonanta Deneef', 'admin@gmail.com', '$2y$10$QFffd/EUYBrsKQW35rnn1u5d0zMaVDmTjtQt535Hb2Wn75Of4RkhK', '085967142870', 2020, 'Laki-Laki', 'admin', '2024-01-05 11:09:18', '2024-03-15 16:38:14', '../uploads/profile/Gambar WhatsApp 2024-01-15 pukul 17.12.51_58e821ae.jpg'),
(59, 'Debby Andriani', 'debby@gmail.com', '$2y$10$t0TTkvzSrp2vxslBsoalzuMGS5HbP.mDdlXp5ZCwC4ssYWOcJT0UW', '085967142870', 2021, 'Perempuan', 'user', '2024-01-26 13:05:56', '2024-03-09 12:30:33', '../uploads/profile/OIP.jpg'),
(62, 'Testes123123', 'tes@gmail.com', '$2y$10$Wyx89/WAO0Vr9.2VRslcIuJA/KuaFiP9vaXYwTm2kN8ggrrh4I9hO', '085967142870', 2022, 'Perempuan', 'user', '2024-01-27 12:40:18', '2024-01-28 08:06:13', NULL),
(77, 'Debby Andriani', 'debby123@gmail.com', '$2y$10$t0TTkvzSrp2vxslBsoalzuMGS5HbP.mDdlXp5ZCwC4ssYWOcJT0UW', '085967142870', 2023, 'Perempuan', 'user', '2024-01-26 13:05:56', '2024-03-09 12:30:33', '../uploads/profile/OIP.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perbandingan_kriteria`
--
ALTER TABLE `perbandingan_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `skrining`
--
ALTER TABLE `skrining`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soal_group`
--
ALTER TABLE `soal_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `perbandingan_kriteria`
--
ALTER TABLE `perbandingan_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `skrining`
--
ALTER TABLE `skrining`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `soal_group`
--
ALTER TABLE `soal_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
