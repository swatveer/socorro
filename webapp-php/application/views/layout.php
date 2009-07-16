<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="<?php echo url::base() ?>css/screen.css" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?php echo url::base() ?>favicon.ico" rel="icon" type="image/png" />
        <?php echo html::script(array('js/__utm.js',
                                      'js/jquery/jquery-1.3.2.min.js',
                                      'js/jquery/plugins/superfish-1.4.8.js',
                                      'js/socorro/nav.js'
                                )); ?>

        <?php slot::output('head') ?>

    </head>

    <body>

        <div id="page-header">
        <div class="header-wrapper">
            <h1><a href="<?php echo url::base() ?>" title="Home">
                <span>Mozilla Crash Reports</span>
            </a></h1>

            <div id="top-nav">
                <ul id="product-nav" class="shortcuts">
                    <li>Quick Links:</li>
                    <?php

                      foreach ($common_products as $prod => $releases) { ?>
                        <li class="product"><a class="functional" href="#"><?= $prod ?> &#9662;</a>
                          <ul class="product-versions">
                                <?php
                            foreach ($releases as $release => $version) { ?>
                                <li><a href="<?= url::base()?>query/query?do_query=1&amp;product=<?= urlencode($prod) ?>&amp;version=<?= urlencode($prod . ':' . $version) ?>"><?= $prod ?> <span class="version"><?= $version ?></span></a> <span class="release-type"><?= $release ?></span></li>
                        <?php }
                                  if (array_key_exists($prod, $older_products)) { ?>
                            <li class="product-nav-other-versions"><a href="#" class="functional">Other Versions &#9662;</a>
                              <ul>
                              <?php
                                  foreach ($older_products[$prod] as $release => $versions) {
                                      foreach ($versions as $version) { ?>
                                   <li><?= $version ?> (<?= $release ?>)</li>
                            <?php     }
                              }			      
                             ?></ul>
                             </li>
                         <?php } ?>

                              
                          </ul>
                          </li><!-- /product -->
                      <?php
                          
                      }
                      ?>
                </ul>
                <ul class="search">
                    <li><a href="<?= url::base() ?>query/query">Advanced Search</a></li>
                    <li>or</li>
                    <li>
                        <form id="simple-search" method="get" action="<?= url::base() ?>query/simple">
                            <input type="text" name="q" value="Crash ID or Signature" />
                            <input type="submit" class="hidden" />
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        </div>

          <li id="trend-nav"><ul>
			<!-- TODO Global current product / version -->
  		        <li id="topcrash-bysig" class="trend-report-link"><span class="label">Top Crashes: </span><a href="<?= url::base() ?>topcrasher/byversion/<?= $chosen_version['product'] ?>/<?= $chosen_version['version'] ?>">By Signature</a></li>
     		        <li id="topcrash-byurl" class="trend-report-link"><span class="label">Top Crashes: </span><a href="<?= url::base() ?>topcrasher/byurl/<?= $chosen_version['product'] ?>/<?= $chosen_version['version'] ?>">By URL</a></li>
      		        <li id="mtbf" class="trend-report-link"><a href="<?= url::base() ?>mtbf/of/<?= $chosen_version['product'] ?>/<?= $chosen_version['release'] ?>">MTBF</a></li>
			</ul></li>
		</ul>
            </div> <!-- /HEADER -->
      
        <div id="mainbody">
	  <div id="vertical-furniture"></div>
  	  <?php echo $content ?></div>

        </div> <!-- /PAGE -->
	
        <div id="footer">
	    <div id="footer-links">
            <ul>
                <li><a href="<?php echo url::base() ?>status?cache_bust=<?php echo time();?>">Server Status</a></li>
                <li><a href="http://code.google.com/p/socorro/">Project Info</a></li>
                <li><a href="http://code.google.com/p/socorro/source">Get the Source</a></li>
                <li><a href="http://wiki.mozilla.org/Breakpad">Breakpad Wiki</a></li>
            </ul>
	    </div>
        </div><!-- /FOOTER -->

    </body>
</html>
