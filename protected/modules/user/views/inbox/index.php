<?php $this->pageTitle = Yii::app()->name . ' - Inbox'; ?>

<div class="page-header one">
    <div class="container">
        <div class="col-md-6 left-padd0">
            <h3 class="font30 nomargin white uppercase">Inbox</h3>
        </div>
        <div class="col-md-6">
            <div class="pagenation"><a href="/">Home</a> <i>/</i> Inbox</div>
        </div>
    </div>
</div>
<!-- end page header -->

<div class="section-lg one">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 messages">
                <div class="row">
                    <div class="col-md-4 left-sidebar">
                        <header>
                            <table class="table">
                                <tr>
                                    <td>
                                        <h3>Messages</h3>
                                    </td>
                                </tr>
                            </table>
                        </header>
                    </div>
                    <div class="col-md-8 right-sidebar">
                        <header>
                            <table class="table">
                                <tr>
                                    <td>
                                        <div class="project-detail">
                                            <h3>swatic</h3>
                                            <p>Project: Build website as...</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="project-detail-limit">
                                            <h3>$250</h3>
                                            <p>in 25 days</p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </header>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end features section 1 -->

<style type="text/css">
    .button a.boxed-color-xs {margin: 0;}

    .messages {border: 1px solid #ccc;}
    .left-sidebar {border-right: 1px solid #cccccc;}
    .left-sidebar, .right-sidebar{height: 450px;}
    .messages header {
        border-bottom: 1px solid #cccccc;
        height: 90px;
    }
    .messages h3 {
  font-weight: bold;
  margin-top: 10px;
}
    td {
        text-align: left;
    }
.project-detail {
  border-right: 1px solid #cccccc;
}
</style>