-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 04 Jul 2024 pada 13.23
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_panen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `beritas`
--

CREATE TABLE `beritas` (
  `id` bigint UNSIGNED NOT NULL,
  `judul_berita` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_berita` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `beritas`
--

INSERT INTO `beritas` (`id`, `judul_berita`, `isi_berita`, `foto`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Berita Pertama', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.', NULL, 'berita-pertama', '2024-07-03 14:02:23', '2024-07-03 14:02:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto_hasil_panens`
--

CREATE TABLE `foto_hasil_panens` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasil_panen_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `foto_hasil_panens`
--

INSERT INTO `foto_hasil_panens` (`id`, `nama`, `hasil_panen_id`, `created_at`, `updated_at`) VALUES
(1, 'img/hasil-panen/1720015806_sedang_1643768209sawah.jpg', 1, '2024-07-03 14:10:06', '2024-07-03 14:10:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gapoktans`
--

CREATE TABLE `gapoktans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_petani` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas_lahan_gapoktan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_gapoktan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` int DEFAULT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat_gapoktan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_gapoktan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penyuluh_id` bigint UNSIGNED DEFAULT NULL,
  `kelompok_id` bigint UNSIGNED DEFAULT NULL,
  `kecamatan_id` bigint UNSIGNED DEFAULT NULL,
  `kelurahan_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gapoktans`
--

INSERT INTO `gapoktans` (`id`, `nama_petani`, `luas_lahan_gapoktan`, `no_hp_gapoktan`, `nik`, `tempat_lahir`, `tgl_lahir`, `alamat_gapoktan`, `status_gapoktan`, `penyuluh_id`, `kelompok_id`, `kecamatan_id`, `kelurahan_id`, `created_at`, `updated_at`) VALUES
(1, 'gapokk', '21', '21', 12345678, 'Banjarmasin', '2024-07-15', '2', '21', 1, 2, 1, 1, '2024-07-04 06:47:52', '2024-07-04 06:47:52'),
(4, 'Semangat', '2100', '0872352673', 213456789, 'Martapura', '2024-07-03', 'BJM', 'ok', 2, 5, 1, 1, '2024-07-04 08:56:33', '2024-07-04 08:56:33'),
(5, 'sas', '21212', '2121', 222111, 'Diubah', '2023-06-06', '21', '21', 1, 4, 4, 4, '2024-07-04 09:10:36', '2024-07-04 13:05:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_panens`
--

CREATE TABLE `hasil_panens` (
  `id` bigint UNSIGNED NOT NULL,
  `luas_lahan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelompok_tani` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_ubinan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_tanam` date DEFAULT NULL,
  `tgl_panen` date DEFAULT NULL,
  `gkp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gkg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasil_produksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_hasil_produksi` text COLLATE utf8mb4_unicode_ci,
  `url_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan_id` bigint UNSIGNED DEFAULT NULL,
  `kelurahan_id` bigint UNSIGNED DEFAULT NULL,
  `penyuluh_id` bigint UNSIGNED DEFAULT NULL,
  `petani` enum('Poktan','Gapoktan') COLLATE utf8mb4_unicode_ci DEFAULT 'Poktan',
  `kelompok_id` bigint DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `is_verified` enum('Pending','Diterima','Ditolak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hasil_panens`
--

INSERT INTO `hasil_panens` (`id`, `luas_lahan`, `kelompok_tani`, `alamat_ubinan`, `tgl_tanam`, `tgl_panen`, `gkp`, `gkg`, `hasil_produksi`, `detail_hasil_produksi`, `url_lokasi`, `kecamatan_id`, `kelurahan_id`, `penyuluh_id`, `petani`, `kelompok_id`, `user_id`, `is_verified`, `created_at`, `updated_at`) VALUES
(1, '2100', 'Tani Muda', 'Kalimantan Selatan', '2024-03-01', '2024-05-01', '200', '150', '1.5', '1.5', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 1, 1, 1, 'Poktan', 1, 1, 'Diterima', '2024-07-03 14:10:06', '2024-07-03 14:14:27'),
(2, '3100', 'Tani Muda', 'Kalimantan Selatan', '2024-03-02', '2024-06-02', '100', '75', '1.03', '1.03', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 1, 1, 2, 'Poktan', 1, 1, 'Diterima', '2024-07-03 14:17:50', '2024-07-03 14:28:12'),
(3, '2000', 'Tani Kuat', 'Kalimantan Selatan', '2024-07-03', '2024-06-03', '80', '60', '1', '1', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 2, 2, 1, 'Gapoktan', 1, 1, 'Diterima', '2024-07-03 14:29:59', '2024-07-03 14:32:35'),
(4, '2500', 'Tani Muslim', 'Kalimantan Selatan', '2024-07-03', '2024-05-03', '200', '190', '1', '1', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 3, 3, 2, 'Poktan', 1, 1, 'Diterima', '2024-07-03 14:31:04', '2024-07-03 14:32:39'),
(5, '3000', 'Tani Sejahtera', 'Kalimantan Selatan', '2024-07-03', '2024-06-03', '250', '210', '1', '1', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 4, 4, 1, 'Poktan', 1, 1, 'Diterima', '2024-07-03 14:31:40', '2024-07-03 14:32:30'),
(6, '4000', 'Tani Jiwa', 'Kalimantan Selatan', '2024-07-03', '2024-06-03', '400', '350', '1', '1', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 5, 5, 1, 'Poktan', 1, 1, 'Diterima', '2024-07-03 14:32:19', '2024-07-03 14:32:24'),
(7, '3100', 'Tani Muda', 'Kalimantan Selatan', '2024-03-02', '2024-07-02', '100', '75', '1.7', '1.7', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 1, 1, 2, 'Poktan', 2, 1, 'Diterima', '2024-07-03 14:17:50', '2024-07-04 07:42:12'),
(8, '2000', 'Tani Kuat', 'Kalimantan Selatan', '2024-03-03', '2024-07-03', '80', '60', '2.21', '2.21', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 2, 2, 1, 'Poktan', 1, 1, 'Diterima', '2024-07-03 14:29:59', '2024-07-03 14:32:35'),
(9, '2500', 'Tani Muslim', 'Kalimantan Selatan', '2024-06-03', '2024-06-03', '200', '190', '1.1', '1.1', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 3, 3, 2, 'Poktan', 2, 1, 'Diterima', '2024-07-03 14:31:04', '2024-07-03 14:32:39'),
(10, '3000', 'Tani Sejahtera', 'Kalimantan Selatan', '2024-07-03', '2024-07-03', '250', '210', '1.75', '1.75', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 4, 4, 1, 'Gapoktan', 1, 1, 'Diterima', '2024-07-03 14:31:40', '2024-07-03 14:32:30'),
(11, '4000', 'Tani Jiwa', 'Kalimantan Selatan', '2024-07-03', '2024-07-03', '400', '350', '2.1', '2.1', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 5, 5, 1, 'Poktan', 1, 1, 'Diterima', '2024-07-03 14:32:19', '2024-07-03 14:32:24'),
(12, '3100', 'Tani Muda', 'Kalimantan Selatan', '2024-03-02', '2024-06-02', '100', '75', '1.03', '1.03', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 1, 1, 2, 'Poktan', 1, 1, 'Diterima', '2024-07-03 14:17:50', '2024-07-03 14:28:12'),
(13, '3100', 'Tani Muda', 'Kalimantan Selatan', '2024-03-02', '2024-06-02', '100', '75', '1.03', '1.03', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 1, 1, 2, 'Poktan', 1, 1, 'Diterima', '2024-07-03 14:17:50', '2024-07-03 14:28:12'),
(14, '2500', 'Tani Muslim', 'Kalimantan Selatan', '2024-06-03', '2024-06-03', '200', '190', '1.1', '1.1', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 3, 3, 2, 'Gapoktan', 1, 1, 'Diterima', '2024-07-03 14:31:04', '2024-07-03 14:32:39'),
(15, '3100', 'Tani Muda', 'Kalimantan Selatan', '2024-03-02', '2024-06-02', '100', '75', '1.03', '1.03', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 1, 1, 2, 'Poktan', 1, 1, 'Diterima', '2024-07-03 14:17:50', '2024-07-03 14:28:12'),
(16, '2500', 'Tani Muslim', 'Kalimantan Selatan', '2024-06-03', '2024-06-03', '200', '190', '1.1', '1.1', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 3, 3, 2, 'Poktan', 2, 1, 'Diterima', '2024-07-03 14:31:04', '2024-07-03 14:32:39'),
(17, '3100', 'Tani Muda', 'Kalimantan Selatan', '2024-03-02', '2024-06-02', '100', '75', '1.03', '1.03', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 1, 1, 2, 'Poktan', 1, 1, 'Diterima', '2024-07-03 14:17:50', '2024-07-03 14:28:12'),
(18, '2500', 'Tani Muslim', 'Kalimantan Selatan', '2024-06-03', '2024-06-03', '200', '190', '1.1', '1.1', 'maps.app.goo.gl/m5n2qPDS5B2gPEJL9', 3, 3, 2, 'Gapoktan', 1, 1, 'Diterima', '2024-07-03 14:31:04', '2024-07-03 14:32:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatans`
--

CREATE TABLE `jabatans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Banjarmasin Tengah', '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(2, 'Banjarmasin Utara', '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(3, 'Banjarmasin Selatan', '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(4, 'Banjarmasin Barat', '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(5, 'Banjarmasin Timur', '2024-07-03 14:02:22', '2024-07-03 14:02:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompoks`
--

CREATE TABLE `kelompoks` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kelompok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelompoks`
--

INSERT INTO `kelompoks` (`id`, `nama_kelompok`, `created_at`, `updated_at`) VALUES
(1, 'Sejahtera team', '2024-07-03 14:02:23', '2024-07-03 14:02:23'),
(2, '21', '2024-07-04 06:47:52', '2024-07-04 06:47:52'),
(3, '21', '2024-07-04 08:47:34', '2024-07-04 08:47:34'),
(4, '212', '2024-07-04 08:55:13', '2024-07-04 08:55:13'),
(5, 'Tani Ok', '2024-07-04 08:56:33', '2024-07-04 08:56:33'),
(6, '212', '2024-07-04 09:10:36', '2024-07-04 09:10:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelurahans`
--

CREATE TABLE `kelurahans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelurahans`
--

INSERT INTO `kelurahans` (`id`, `nama`, `kecamatan_id`, `created_at`, `updated_at`) VALUES
(1, 'Sungai Jingah', 1, '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(2, 'Sungai Andai', 2, '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(3, 'Basirih Selatan', 3, '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(4, 'Telawang', 4, '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(5, 'Kuripan', 5, '2024-07-03 14:02:22', '2024-07-03 14:02:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_27_133301_create_hasil_panens_table', 1),
(6, '2023_11_28_094432_create_kelurahans_table', 1),
(7, '2024_04_24_123024_create_poktans_table', 1),
(8, '2024_04_24_123726_create_gapoktans_table', 1),
(9, '2024_04_24_124636_create_penyuluhs_table', 1),
(10, '2024_04_24_125015_create_kelompoks_table', 1),
(11, '2024_04_24_125419_create_jabatans_table', 1),
(12, '2024_04_24_125531_create_pegawais_table', 1),
(13, '2024_05_08_141001_create_permission_tables', 1),
(14, '2024_05_15_142215_create_beritas_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(5, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyuluhs`
--

CREATE TABLE `penyuluhs` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_penyuluh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_penyuluh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_penyuluh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_penyuluh` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `poktan_id` bigint UNSIGNED DEFAULT NULL,
  `gapoktan_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penyuluhs`
--

INSERT INTO `penyuluhs` (`id`, `nama_penyuluh`, `nip_penyuluh`, `no_hp_penyuluh`, `alamat_penyuluh`, `poktan_id`, `gapoktan_id`, `created_at`, `updated_at`) VALUES
(1, 'Budi', '1234567890', '081208120812', 'sungai jingah', NULL, NULL, '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(2, 'Penyuluh', '1234567890', '081208120812', 'sungai jingah', NULL, NULL, '2024-07-03 14:02:23', '2024-07-03 14:02:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin-access', 'web', '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(2, 'petani-access', 'web', '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(3, 'penyuluh-access', 'web', '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(4, 'kabid-access', 'web', '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(5, 'pegawai-access', 'web', '2024-07-03 14:02:22', '2024-07-03 14:02:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `poktans`
--

CREATE TABLE `poktans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_petani` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas_lahan_poktan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_poktan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` int DEFAULT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `status_poktan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_poktan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyuluh_id` bigint UNSIGNED DEFAULT NULL,
  `kelompok_id` bigint UNSIGNED DEFAULT NULL,
  `kecamatan_id` bigint UNSIGNED DEFAULT NULL,
  `kelurahan_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `poktans`
--

INSERT INTO `poktans` (`id`, `nama_petani`, `luas_lahan_poktan`, `no_hp_poktan`, `nik`, `tempat_lahir`, `tgl_lahir`, `status_poktan`, `alamat_poktan`, `penyuluh_id`, `kelompok_id`, `kecamatan_id`, `kelurahan_id`, `created_at`, `updated_at`) VALUES
(1, 'Sejahtera', '5 hektar', '081208120812', 1234567800, 'Banjarmasin', '2024-07-01', 'aktif', 'sungai jingah', 1, NULL, 1, 1, '2024-07-03 14:02:23', '2024-07-03 14:02:23'),
(2, 'Ismail', '10 hektar', '212121', 1234567811, 'Banjarmasin', '2024-07-04', '2121', '212121', 2, NULL, 5, 5, '2024-07-04 05:58:27', '2024-07-04 13:09:50'),
(7, 'sas', 'asa', '21', 2121233332, 'OKOKO', '2024-08-10', '1212', '212', 2, NULL, 2, 2, '2024-07-04 09:08:50', '2024-07-04 13:08:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(2, 'admin', 'web', '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(3, 'petani', 'web', '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(4, 'penyuluh', 'web', '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(5, 'kabid', 'web', '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(6, 'pegawai', 'web', '2024-07-03 14:02:22', '2024-07-03 14:02:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `telp`, `foto`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@hotmail.com', '081208120812', NULL, 'Aktif', '$2y$10$pMdHLFZnqpW0MdEAtCXhkuHXsh1bU/tBR6Jte6KHaZynCeUW9.BeC', NULL, '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(2, 'Penyuluh', 'penyuluh', 'penyuluh@hotmail.com', '081208120812', NULL, 'Aktif', '$2y$10$kz66g6KVFiNTnhrpQwWGRORqmEPx.0uPE7MISqWrnsXI6V13q.JE.', NULL, '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(3, 'Petani', 'petani', 'petani@hotmail.com', '081208120812', NULL, 'Aktif', '$2y$10$rG4PaxVtH59zn4XAdPrDR.XEeZBvIlIOsqwXpCQ0mTdyxyK2Mf7Me', NULL, '2024-07-03 14:02:22', '2024-07-03 14:02:22'),
(4, 'Kabid', 'kabid', 'kabid@hotmail.com', '081208120812', NULL, 'Aktif', '$2y$10$j5sUCL7R/Sgeyb688TS.b.Ec2mCMuj6uSaIGRAnmTtGeYKlFPyVZu', NULL, '2024-07-03 14:02:22', '2024-07-03 14:02:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `foto_hasil_panens`
--
ALTER TABLE `foto_hasil_panens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gapoktans`
--
ALTER TABLE `gapoktans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil_panens`
--
ALTER TABLE `hasil_panens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatans`
--
ALTER TABLE `jabatans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelompoks`
--
ALTER TABLE `kelompoks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelurahans`
--
ALTER TABLE `kelurahans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penyuluhs`
--
ALTER TABLE `penyuluhs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `poktans`
--
ALTER TABLE `poktans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `beritas`
--
ALTER TABLE `beritas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `foto_hasil_panens`
--
ALTER TABLE `foto_hasil_panens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `gapoktans`
--
ALTER TABLE `gapoktans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `hasil_panens`
--
ALTER TABLE `hasil_panens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kelompoks`
--
ALTER TABLE `kelompoks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kelurahans`
--
ALTER TABLE `kelurahans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penyuluhs`
--
ALTER TABLE `penyuluhs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `poktans`
--
ALTER TABLE `poktans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
