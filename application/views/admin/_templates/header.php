<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *
 * MY CONSTANT
 * 
 */
$bootstrap_dir = base_url($bootstrap_dir);
const SUB_FOLDER = 'admin/';
const SUB_NUMBER = 2; //base_url 0,
const MENU_ITEM_DEFAULT = 'home';
const HOME_REDIRECT = 'admin/'; // sample    admin/

$main_sub   = '';
/**
 * navigation
 */
$menu_items = $navigations;


// Determine the current menu item.
$menu_current = MENU_ITEM_DEFAULT;
// If there is a query for a specific menu item and that menu item exists...
if (@array_key_exists($this->uri->segment(SUB_NUMBER), $menu_items))
{
        $menu_current = $this->uri->segment(SUB_NUMBER);
}
if (MENU_ITEM_DEFAULT == $menu_current)
{
        foreach ($menu_items as $key => $item)
        {
                if (isset($item['sub']))
                {
                        if (@array_key_exists($this->uri->segment(SUB_NUMBER), $item['sub']))
                        {
                                $main_sub     = $key;
                                $menu_current = $this->uri->segment(SUB_NUMBER);
                                break;
                        }
                }
        }
}

$label     = html_escape(((isset($menu_items[$menu_current]['label'])) ? $menu_items[$menu_current]['label'] : $menu_items[$main_sub]['label']));
$sub_label = html_escape(((isset($menu_items[$menu_current]['label'])) ? '' : $menu_items[$main_sub]['sub'][$this->uri->segment(SUB_NUMBER)]['label']));
echo doctype('html5');
?>
<html>
    <head>
        <meta charset="<?php echo $this->config->item('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo ($sub_label != '') ? $sub_label : $label; ?> | <?php echo $this->config->item('public_name'); ?></title>
        <?php echo link_tag('assets/images/icon.png', 'shortcut icon', 'image/ico'); ?>
        <link href="<?php echo $bootstrap_dir; ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $bootstrap_dir; ?>css/datepicker3.css" rel="stylesheet">
        <link href="<?php echo $bootstrap_dir; ?>css/styles.css" rel="stylesheet">
        <link href="<?php echo $bootstrap_dir; ?>css/bootstrap-table.css" rel="stylesheet">
        <!--Icons-->
        <script src="<?php echo $bootstrap_dir; ?>js/lumino.glyphs.js"></script>
        <!--[if lt IE 9]>
        <script src="<?php echo $bootstrap_dir; ?>js/html5shiv.js"></script>
        <script src="<?php echo $bootstrap_dir; ?>js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(HOME_REDIRECT); ?>">
                        <?php
                        echo $this->config->item('admin_title');
                        ?></a>
                    <ul class="user-menu">
                        <li class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $this->session->userdata('admin_fullname'); ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url(SUB_FOLDER); ?>home/logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- /.container-fluid -->
        </nav>
        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <form role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
            </form>
            <ul class="nav menu">
                <?php
                /**
                 * navigations
                 */
                foreach ($menu_items as $key => $item)
                {
                        if (isset($item['sub']))
                        {
                                //sub menu
                                $active1 = ($key == $main_sub ? ' active' : '');
                                echo '<li class="parent' . $active1 . '">';
                                echo '<a href="#">';
                                echo '<span data-toggle="collapse" href="#sub-item-' . $key . '">';
                                echo '<svg class="glyph stroked ' . str_replace('-', ' ', $item['icon']) . '"><use xlink:href="#stroked-' . $item['icon'] . '"/></svg>';
                                echo '</span>';
                                echo $item['label'];
                                echo '</a>';
                                //start sub menu 
                                echo '<ul class="children collapse" id="sub-item-' . $key . '">';
                                foreach ($item['sub'] as $sub_key => $sub_item)
                                {
                                        echo '<li>'
                                        . '<a href="' . base_url(SUB_FOLDER . $sub_key) . '">'
                                        . '<svg class="glyph stroked download"><use xlink:href="#stroked-' . $sub_item['icon'] . '"/></svg> '
                                        . $sub_item['label'] . '</a>'
                                        . '</li>';
                                }
                                echo '</ul>';
                                echo '</li>';
                        }
                        else
                        {
                                $active = ($key == $menu_current ? ' class="active"' : '');
                                echo '<li' . $active . '>'
                                . '<a href="' . base_url(SUB_FOLDER . $key) . '">'
                                . '<svg class="glyph stroked ' . str_replace('-', ' ', $item['icon']) . '"><use xlink:href="#stroked-' . $item['icon'] . '"/></svg> '
                                . $item['label'] . '</a>'
                                . '</li>';
                        }
                }
                ?>
            </ul>
        </div><!--/.sidebar-->
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	<!--main-->
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url('admin'); ?>"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                    <li class="active">
                        <?php
                        echo '<a href="' . (($sub_label != '') ? '#' : base_url(SUB_FOLDER . $menu_current) ) . '">'
                        . $label . '</a>' . (($sub_label != '') ? '</li><li>'
                                . '<a href="' . base_url(SUB_FOLDER . $menu_current) . '">'
                                . $sub_label
                                . '</a>' : '' );
                        ?>
                    </li>
                    <li>
                        <?php
                        // echo now('Asia/Manila');
                        $datestring = '%Y %m %d - %D %h:%i %a';
                        $time       = time();
                        echo mdate($datestring, $time);
                        ?>
                    </li>
                    <?php
                    if (ENVIRONMENT === 'development')
                    {

                            echo comment_tag('version: ' . CI_VERSION . '');
                    }
                    ?>
                </ol>
            </div><!--/.row-->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo(($sub_label != '') ? $sub_label : $label ); ?></h1>
                </div>
            </div>
