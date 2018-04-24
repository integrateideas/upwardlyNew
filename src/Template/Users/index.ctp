<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="content animate-panel">
    <div class="row">
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
                            </div>
                            <!-- <dl class="small m-t-md">
                                <dt>Description lists</dt>
                                <dd>A description list is perfect for defining terms.</dd>
                                <dt>Euismod</dt>
                                <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                                <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                                <dt>Malesuada porta</dt>
                                <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
                            </dl> -->
                            <hr>
                        </div>
                    </div>
                

                </div>
            </div>
        </div>
       <?php endforeach; ?>
    </div>
</div>

<style type="text/css">
    @media print { 
        p h1 h2 h3 {
            font-size:10px;
        }
        @page {
              size: letter landscape;
              margin: 0;
            }

/*        hr {page-break-after: always;}*/
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

    }

</style>
<script type="text/javascript">
    $(document).ready(function(){
        window.print();
    })
</script>
