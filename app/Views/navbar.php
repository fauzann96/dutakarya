<style type="text/css">
  nav{
  background: white;
  height:fit-content;
  width: 100%;
  position: fixed;
  
  top: 0;
  left: 0;

  box-shadow: 0px -5px 20px 0px rgb(17 87 18);
}
img.avatar {
  width: 90px;
  border-radius: 0%;
}

.company_name {
  margin-inline: 10px;
  color: #125210;
}
.nav_right{
  display: flex;
  float: right;
  height: 56px;
  align-items: center;
  margin-right: 10px;
}
.nav_left{
  float: left;
  height: 56px;
  display: flex;
  align-items: center;
  padding-inline: 10px;
}
@media (max-width: 576px) {
        .nav_left h2 {
          display: none;
        }
      }


.dropbtn {
  background-color: #125210;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  margin-right: 10px;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
</style>
<nav>
  <div class="nav_left">
    <img src="<?= base_url('upload/system/logo_dks.jpg')?>" alt="Avatar" class="avatar">
    <h2 class="company_name">PT Duta Karya Sinergi</h2>
  </div>
  <div class="nav_right">
    <div class="dropdown">
      <button class="dropbtn">Halo, Ali</button>
      <div class="dropdown-content">
      <a href="#">Profil Saya</a>
      <a href="#">Logout</a>
      </div>
    </div>
  </div>
</nav>