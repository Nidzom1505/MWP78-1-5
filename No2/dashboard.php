<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

$jumlahPostingan = 0;
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT COUNT(*) FROM postingan WHERE username = $1";
    $result = pg_query_params($conn, $query, array($username));
    if ($result) {
        $row = pg_fetch_row($result);
        $jumlahPostingan = $row[0];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="icon" href="aset/11053969_x_logo_twitter_new_brand_icon.svg">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="con-kiri">
            <div class="kiri-jarak">
                <img src="aset/Xtrans.svg" alt="X" id="logo">

                <div class="home">
                    <img src="aset/icons8-home.svg" alt="home" id="home">
                    <h6 id="ber">Beranda</h6>
                </div>

                <div class="search">
                    <img src="aset/icons8-search (1).svg" alt="search" id="search">
                    <h6 id="ber">Jelajahi</h6>
                </div>

                <div class="notif">
                    <img src="aset/icons8-bell.svg" alt="mail" id="notif">
                    <h6 id="ber">Notifikasi</h6>
                </div>

                <div class="pesan">
                    <img src="aset/mail.svg" alt="mesage" id="pesan">
                    <h6 id="ber">Pesan</h6>
                </div>

                <div class="grok">
                    <img src="aset/grok.svg" alt="grok" id="grok">
                    <h6 id="ber">Grok</h6>
                </div>

                <div class="com">
                    <img src="aset/community.svg" alt="community" id="com">
                    <h6 id="ber">Komunitas</h6>
                </div>

                <div class="prem">
                    <img src="aset/verified-svgrepo-com.svg" alt="premium" id="prem">
                    <h6 id="ber">Premium</h6>
                </div>

                <div class="or">
                    <img src="aset/lightning-02-svgrepo-com.svg" alt="organisasi" id="or">
                    <h6 id="ber">Organisasi Terverifikasi</h6>
                </div>

                <a href="profil.php" class="home-link">
                    <div class="pro">
                        <img src="aset/profile-svgrepo-com.svg" alt="profile" id="pro">
                        <h6 id="ber">Profil</h6>
                    </div>
                </a>

                <div class="lain">
                    <img src="aset/more-options-ellipsis-icon.svg" alt="other" id="lain">
                    <h6 id="ber">Lainnya</h6>
                </div><br>

                <div>
                    <button class="postingBtn" id="postingBtn">
                        <h4 id="pos">Posting</h4>
                    </button>
                </div><br><br><br>

                <div class="profile-kiri">
                    <img src="aset/default_profile_400x400.png" alt="Profile" id="photo">
                    <div class="profile-text">
                        <h4 id="nama"><?php echo $_SESSION['username']; ?></h4>
                        <h4 id="user">@<?php echo $_SESSION['username']; ?></h4>
                    </div>
                    <img src="aset/elipsis-h-svgrepo-com.svg" alt="elip" class="elipsis" id="btn-logout">
                </div>
            </div>
        </div>

        <div class="con-tengah">
            <div class="konten">
                <?php
                include 'koneksi.php';

                $query = pg_query($conn, "SELECT * FROM postingan ORDER BY tanggal_post DESC");

                while ($post = pg_fetch_assoc($query)) {
                    $id_post = $post['id'];
                    $username = htmlspecialchars($post['username']);
                    $isi = nl2br(htmlspecialchars($post['isi']));
                    $tanggal = $post['tanggal_post'];

                    $replies = pg_query_params($conn, "SELECT * FROM reply WHERE id_postingan = $1 ORDER BY tanggal_reply ASC", array($id_post));
                    $jumlah_reply = pg_num_rows($replies);

                    echo '<div class="postingan">';
                    echo '  <div class="post-kiri">';
                    echo '      <img src="aset/default_profile_400x400.png" alt="profile">';
                    echo '  </div>';
                    echo '  <div class="post-kanan">';
                    echo "      <h3>$username</h3>";
                    echo "      <p>$isi</p>";

                    echo '      <div class="postingan-reply">';
                    echo '          <div class="postingan-reply-jumlah">';
                    echo '              <img src="aset/comment-1-svgrepo-com.svg" class="btn-reply" 
            data-id="' . $id_post . '" 
            data-username="' . $username . '" 
            data-isi="' . htmlspecialchars($post['isi']) . '">';
                    echo $jumlah_reply > 0 ? '<p>' . $jumlah_reply . '</p>' : '<p></p>';
                    echo '          </div>';
                    echo "          <small>$tanggal</small>";
                    echo '      </div>';

                    if ($jumlah_reply > 0) {
                        while ($rep = pg_fetch_assoc($replies)) {
                            echo '<div class="balasan">';
                            echo '<strong>' . htmlspecialchars($rep['username']) . '</strong>: ';
                            echo nl2br(htmlspecialchars($rep['isi']));
                            echo '</div>';
                        }
                    }

                    echo '  </div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <div class="con-kanan">
            <div class="kanan-search">
                <div class="searchBar">
                    <img src="aset/icons8-search (1).svg" id="cari">
                    <input type="text" placeholder="Cari" class="inputCari">
                </div>
            </div>


            <div class="kanan-suka" id="rekomen">
                <h1 id="anda">Anda mungkin suka</h1>
                <div class="hangat-item">
                    <img src="aset/default_profile_400x400.png" alt="Profile" id="photo">
                    <div class="profilee-text">
                        <h4 id="namaa">M. Nidzom Imtiyaz</h4>
                        <h4 id="user">@NidzomImtiyaz</h4>
                    </div>
                    <button class="ikuti">Ikuti</button>
                </div>

                <div class="profilee-text1">
                    <img src="aset/default_profile_400x400.png" alt="Profile" id="photo">
                    <div class="profilee-text">
                        <h4 id="namaa">Uinsa official</h4>
                        <h4 id="user">@uinsa.official</h4>
                    </div>
                    <button class="ikuti">Ikuti</button>
                </div>

                <div class="profilee-text2">
                    <img src="aset/default_profile_400x400.png" alt="Profile" id="photo">
                    <div class="profilee-text">
                        <h4 id="namaa">Aku Sayang kamu</h4>
                        <h4 id="user">@ask.com</h4>
                    </div>
                    <button class="ikuti">Ikuti</button>
                </div>

                <div class="trend-item" id="suka-banyak">
                    <h5>Tampilkan lebih banyak</h5>
                </div>
            </div>

            <div class="kanan-hangat">
                <h1 id="anda">Sedang hangat dibicarakan</h1>
                <div class="trend-item">
                    <span class="trend-category">Musik · Populer</span>
                    <p class="trend-name">Emil</p>
                    <span class="trend-count">20,5 rb postingan</span>
                    <span class="more-options">•••</span>
                </div>

                <div class="trend-item">
                    <span class="trend-category">Musik · Populer</span>
                    <p class="trend-name">BAEKHYUN</p>
                    <span class="trend-count">20,5 rb postingan</span>
                    <span class="more-options">•••</span>
                </div>

                <div class="trend-item">
                    <span class="trend-category">sedang tren dalam topik Indonesia</span>
                    <p class="trend-name">Minggu</p>
                    <span class="trend-count">20,5 rb postingan</span>
                    <span class="more-options">•••</span>
                </div>

                <div class="trend-item">
                    <span class="trend-category">Kampus · Populer</span>
                    <p class="trend-name">UINSA</p>
                    <span class="trend-count">20,5 rb postingan</span>
                    <span class="more-options">•••</span>
                </div>

                <div class="trend-item" id="hangat-banyak">
                    <h5>Tampilkan lebih banyak</h5>
                </div>
            </div><br>

            <div class="kanan-akhir">
                <a href="#">Persyaratan Layanan</a>
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Kebijakan Penggunaan Kuki</a>
                <a href="#">Aksesibilitas</a>
                <a href="#">Informasi Iklan</a>
                <a href="#">Lainnya •••</a>
                <span>© 2025 X Corp.</span>
            </div>
        </div>

        <div class="grok-btn">
            <img src="aset/grok.svg" alt="GROK">
            <span>GROK</span>
        </div>

        <div class="pesan-bar">
            <span class="pesan-title">Pesan</span>
            <div class="pesan-icons">
                <i class="fas fa-envelope"></i>
                <i class="fas fa-chevron-up"></i>
            </div>
        </div>
    </div>


    <!-- modals -->
    <div id="modal-post">
        <div class="post">
            <div class="post-top">
                <img src="aset/close-svgrepo-com.svg" alt="" class="close" id="close">
                <h6>Draf</h6>
            </div>

            <div class="post-form">
                <img src="aset/default_profile_400x400.png" alt="profile">
                <textarea placeholder="Apa yang terjadi?"></textarea>
            </div>

            <div class="post-bottom">
                <button>Posting</button>
            </div>
        </div>
    </div>

    <!-- modals reply-->
    <div id="modal-reply">
        <div class="reply">
            <div class="reply-top">
                <img src="aset/close-svgrepo-com.svg" alt="" class="close" id="close">
                <h6>Draf</h6>
            </div>

            <div class="reply-preview"></div>

            <div class="reply-form">
                <img src="aset/default_profile_400x400.png" alt="profile">
                <textarea placeholder="Tambahkan postingan lainnya"></textarea>
            </div>

            <div class="reply-bottom">
                <button>Posting</button>
            </div>
        </div>
    </div>

    <!-- notif -->
    <div id="toast" class="toast">Postingan berhasil!</div>

    <!-- log out -->
    <div class="logout" id="logout-popup">
        <a href="logout.php" class="logout-popup">Log Out</a>
    </div>

    <script>
        $(function () {
            $("#postingBtn").click(function () {
                $("#modal-post").fadeIn().css("display", "flex");
            })

            $("#close").click(function () {
                $("#modal-post").fadeOut();
            })
        })

        // posting
        document.addEventListener("DOMContentLoaded", function () {
            const textarea = document.querySelector("#modal-post textarea");
            const postBtn = document.querySelector(".post-bottom button");

            textarea.addEventListener('input', () => {
                const isKosong = textarea.value.trim() === '';
                postBtn.disabled = isKosong;

                if (isKosong) {
                    textarea.style.backgroundColor = '';
                    textarea.style.color = '';
                    postBtn.style.backgroundColor = 'rgba(0, 0, 0, 0.2)';
                } else {
                    postBtn.style.backgroundColor = 'black';
                }
            });

            postBtn.addEventListener("click", function () {
                const isi = textarea.value.trim();

                if (isi !== "") {
                    fetch("post.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `isi=${encodeURIComponent(isi)}`
                    })
                        .then(response => response.text())
                        .then(data => {
                            if (data === 'sukses') {
                                textarea.value = "";
                                postBtn.disabled = true;
                                postBtn.style.backgroundColor = 'rgba(0, 0, 0, 0.2)';
                                document.getElementById("close").click();
                                showToast("Postingan berhasil dikirim!");
                            } else {
                                showToast("Gagal menyimpan postingan.");
                            }
                        });
                }
            });

            function showToast(message) {
                const toast = document.getElementById("toast");
                toast.textContent = message;
                toast.classList.add("show");
                setTimeout(() => {
                    toast.classList.remove("show");
                }, 3000);
            }
        });

        // reply
        document.addEventListener("DOMContentLoaded", function () {
            const modalReply = document.getElementById("modal-reply");
            const replyTextarea = modalReply.querySelector("textarea");
            const replyPreview = modalReply.querySelector(".reply-preview");

            document.querySelector(".konten").addEventListener("click", function (e) {
                if (e.target.classList.contains("btn-reply")) {
                    const username = e.target.getAttribute("data-username");
                    const isi = e.target.getAttribute("data-isi");
                    const id = e.target.getAttribute("data-id");

                    modalReply.setAttribute("data-id", id);
                    replyPreview.innerHTML = `<div class="preview"><strong>${username}</strong>: ${isi}</div>`;
                    replyTextarea.value = "";
                    modalReply.style.display = "flex";
                }
            });

            modalReply.querySelector(".close").addEventListener("click", function () {
                modalReply.style.display = "none";
                replyTextarea.value = "";
                replyPreview.innerHTML = "";
            });

            modalReply.querySelector("button").addEventListener("click", function () {
                const isi = replyTextarea.value.trim();
                const id = modalReply.getAttribute("data-id");

                if (isi !== "") {
                    fetch("reply.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `isi=${encodeURIComponent(isi)}&id=${id}`
                    })
                        .then(res => res.text())
                        .then(data => {
                            if (data === "sukses") {
                                location.reload();
                            } else {
                                alert("Gagal mengirim reply.");
                            }
                        });
                } else {
                    alert("Balasan tidak boleh kosong!");
                }
            });
        });

        document.getElementById("btn-logout").addEventListener("click", function (e) {
            const popup = document.getElementById("logout-popup");
            popup.style.display = (popup.style.display === "flex") ? "none" : "flex";

            e.stopPropagation();
        });

        document.addEventListener("click", function (e) {
            const popup = document.getElementById("logout-popup");
            const btn = document.getElementById("btn-logout");

            if (!popup.contains(e.target) && !btn.contains(e.target)) {
                popup.style.display = "none";
            }
        });


        document.addEventListener("DOMContentLoaded", function () {
            if (!localStorage.getItem("postingan")) {
                // Ambil data
                fetch("dataDummy.json")
                    .then(response => response.json())
                    .then(data => {
                        localStorage.setItem("postingan", JSON.stringify(data));
                        renderPosts(data);
                    })
                    .catch(error => console.error("Gagal memuat data dummy:", error));
            } else {
                const postingan = JSON.parse(localStorage.getItem("postingan"));
                renderPosts(postingan);
            }

            function renderPosts(postingan) {
                const konten = document.querySelector(".konten");
                postingan.forEach(post => {
                    const postElement = document.createElement("div");
                    postElement.classList.add("postingan");
                    postElement.innerHTML = `
                    <div class="post-kiri">
                        <img src="aset/default_profile_400x400.png" alt="profile">
                    </div>
                    <div class="post-kanan">
                        <h3>${post.username}</h3>
                        <p>${post.isi}</p>
                        <div class="postingan-reply">
                            <div class="postingan-reply-jumlah">
                                <img src="aset/comment-1-svgrepo-com.svg" class="btn-reply" data-id="${post.id}">
                                <p>${post.replies.length}</p>
                            </div>
                            <small>${post.tanggal_post}</small>
                        </div>
                    </div>
                `;
                    konten.appendChild(postElement);
                });
            }
        });
    </script>
</body>

</html>