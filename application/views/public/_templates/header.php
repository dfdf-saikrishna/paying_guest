<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$bootstrap_dir = base_url($bootstrap_dir);
echo doctype('html5');
?>
<html lang="en">
    <head>
        <meta charset="<?php echo $this->config->item('charset') ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title . ' | ' . $this->config->item('public_name'); ?></title>  
        <?php echo link_tag('assets/images/icon.png', 'shortcut icon', 'image/ico'); ?>
        <?php echo $controller->resources($bootstrap_dir); ?>
    </head>
    <body class="mg-boxed">
        <div class="preloader"></div>
        <header class="header transp sticky"> <!-- available class for header: .sticky .center-content .transp -->
            <nav class="navbar navbar-inverse">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/images/logo.png') ?>" alt="logo"></a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <?php
                            //preparing navigations
                            foreach ($navigations as $k => $v):
                                    $active = ( $v === $title) ? '  class="active"' : '';
                                    ?>
                                    <li<?php echo $active; ?>><a href="<?php echo base_url($k); ?>"><?php echo $v; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                    <div class="mg-search-box-cont pull-right">
                        <a href="#" class="mg-search-box-trigger"><i class="fa fa-search"></i></a>
                        <div class="mg-search-box">
                            <form>
                                <input type="text" name="s" class="form-control" placeholder="Type Keyword...">
                                <button type="submit" class="btn btn-main"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </nav>
        </header>
