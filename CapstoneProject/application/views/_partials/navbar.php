<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <a class="navbar-brand" href="/">Dojo eCommerce
    
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <?php if($this->session->userdata('user') && $this->session->userdata('user')->is_admin == 1){?>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/products">Products</a>
            </li>
        <?php }?>
  
          
  
        <!-- <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li> -->
        </ul>
        <?php if(!$this->session->userdata('user')){?>
 
            <form class="form-inline my-2 my-lg-0">
                <a href="/signin" class="btn my-2 my-sm-0">Sign In</a>
            </form>
        <?php }?>
     
  
        <?php if($this->session->userdata('user')){?>
            <form class="form-inline my-2 my-lg-0">
                <a href="/logout" class="btn my-2 my-sm-0">Logout</a>
            </form>
        <?php }?>
            <a href="#" class="cart"><i class="fa fa-shopping-cart"></i><span id="card-number">2</span></a>
  
    </div>
  </div>
</nav>