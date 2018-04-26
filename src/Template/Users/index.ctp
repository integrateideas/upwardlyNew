<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="content animate-panel">
    <div class="row">
    <?php if(!empty($results) && isset($results)){ ?>
        <?php foreach ($results as $value): ?>
        <div class="col-lg-12">
            <div class="ibox product-detail">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="product-images">
                                <div>
                                    <div class="image-imitation">
                                        <img style="width:400px;height:400px;" src="<?php echo $value['images'][0]['src'];?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h2 class="font-bold m-b-xs"><?php echo $value['name'];?></h2>
                            <div class="m-t-md">
                                <h2 class="product-main-price">Price : <?php echo $value['price'];?></h2>
                            </div>
                            <h4>Product description</h4>
                            <div class="small text-muted">
                                <?php echo $value['description'];?>
                                <!-- upsell_product_info -->
                            </div>
                            
                            
                            <?php if(!empty($value['attributes']) && isset($value['attributes'])){  ?>
                            <?php foreach ($value['attributes'] as $attriValue) { ?>
                                <dl class="small m-t-md">
                                    <dt><?php echo $attriValue['name'];?> : <?php foreach ($attriValue['options'] as $key => $attriOptions) { ?><em><?php echo $attriOptions;?></em><?php }?> &nbsp;</dt> 
                                        

                                </dl>
                            <?php } } ?>


                        </div>
                    </div>

                    <div class="row">
                    <?php if(!empty($value['upsell_product_info']) && isset($value['upsell_product_info'])){  ?>
                        <div class="ibox-title">
                            <h5>Upgrades</h5>
                        </div>
                        <?php foreach ($value['upsell_product_info'] as $upsellValue) { ?>


                        <div class="col-lg-4">
                            <div class="ibox">
                                <div class="ibox-content">
                                    <h4><?php echo $upsellValue['name']; ?></h4>
                                    <div class="small m-b-xs">
                                        <strong>Price <?php echo $upsellValue['price'];?></strong>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php if(!empty($upsellValue['images'][0])){ ?>
                                                <img style="width:300px;height:300px;" src="<?php echo $upsellValue['images'][0]['guid'];?>">
                                            <?php } else{ ?>
                                                <img style="width:300px;height:300px;" src="https://revmaxconverters.com/wp-content/uploads/2016/06/RevMax-Placeholder-BG4-1-500x500.png">
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } } ?>
                        
                    </div>
                

                </div>
            </div>
        </div>
        
       <?php endforeach; }?>

    </div>
</div>

<style type="text/css">
    /*@media print { 
        p h1 h2 h3 {
            font-size:10px;
        }
        @page {
              size: letter landscape;
              margin: 0;
            }
        .row {
            margin-right: -15px;
            margin-left: -15px;
            width: 100%;
        }

        li{
          margin: 5px 0;
        }

        .wrapper {
            width:100%;
        }

        #wrapper {
            width:100%;  
        }
        div {
            display: block;
        }
        .col-md-7 {
            width: 58.33333333%;
            float: left;
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }
        .col-md-5 {
            width: 41.66666667%;
        }

        footer {
            position: fixed;
            bottom: 0;
             font-size: 9px;
            color: #f00;
            text-align: center;
          }
        header {
            position: fixed;
            top: 0;
          }
        body {
            height: 100%;
            width: 100%;
            display: block;
            margin: 8px;
            font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            background-color: #2f4050;
            font-size: 13px;
            color: #676a6c;
            overflow-x: hidden;
        }

        .gray-bg {
            background-color: #f3f3f4;
        }

    }*/

</style>
<script type="text/javascript">
    /*$(document).ready(function(){
        window.print();
    })*/
</script>


    
