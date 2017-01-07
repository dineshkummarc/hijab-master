<div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="grid-full">
                        <ul>
                            <li>
                                <a href="#">Home</a>
                                <span> / </span>
                            </li>
                            <li><?php echo $controller_name; if($this->uri->segment(2)){echo" / ".$this->uri->segment(2);} ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>