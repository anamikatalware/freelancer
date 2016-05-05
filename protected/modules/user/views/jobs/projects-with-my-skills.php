<?php
$this->pageTitle = Yii::app()->name . ' - My Account';
$current_user = Yii::app()->user->id;
?>

<div class="page-header two">
    <div class="container">
        <div class="col-md-6 left-padd0">
            <h3 class="font30 nomargin white uppercase">Jobs Matching with My Skills</h3>
        </div>
        <div class="col-md-6">
            <div class="pagenation"><a href="index.html">Dashboard</a> <i>/</i> Projects with My Skills</div>
        </div>
    </div>
</div>
<!-- end page header -->

<div class="section-lg one">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="sky-form" id="sky-form" action="index.html" novalidate="novalidate">
                    <fieldset>
                        <section>
                            <div class="row">
                                <label class="label col col-4">Search</label>
                                <div class="col col-8">
                                    <label class="input"> 
                                        <i class="icon-append fa fa-search"></i>
                                        <input type="text" name="search">
                                    </label>
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="row">
                                <label class="label col col-4">Skills</label>
                                <div class="col col-8">
                                    <label class="input">
                                        <input type="text" name="skills">
                                    </label>
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="row">
                                <label class="label col col-4">Job Types</label>
                                <div class="col col-4">
                                    <label class="checkbox">
                                        <input type="checkbox" checked="" name="remember">
                                        <i></i> Fixed Price Projects
                                    </label>
                                </div>
                                <div class="col col-4">
                                    <label class="checkbox">
                                        <input type="checkbox" checked="" name="remember">
                                        <i></i> Hourly Projects
                                    </label>
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="row">
                                <label class="label col col-4">Location</label>
                                <div class="col col-8">
                                    <label class="input">
                                        <i class="icon-append fa fa-location-arrow"></i>
                                        <input type="text" name="location">
                                    </label>
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="row">
                                <div class="col col-4">
                                    <button class="button"><i class="fa fa-list-alt"></i> More Options</button>
                                    <button class="button">Clear Filters</button>
                                </div>
                                <div class="col col-8" style="line-height: 65px;">
                                    <div class="row">
                                        <div class="col-sm-2">                                            
                                            <label>Results per page</label>                                             
                                        </div>
                                        <div class="col-sm-1">
                                            <select class="form-control">
                                                <option>20</option>
                                                <option>50</option>
                                                <option>100</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-8">
                                            display YII Pagination here
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="project-list">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>Project</td>
                                <td>Bids/Entries</td>
                                <td style="width: 150px;">Started</td>
                                <td style="width: 150px;">Price (USD)</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="project-description text-left">
                                        <h2><i class="fa fa-terminal"></i> CAMERA AND MICROPHONE ACTIVITY DETECTOR -- 2</h2>
                                        <p>I need an application that can detect if the camera or microphone on a windows computer is in use, and give pop up box if it is. Contact for more details. Small project. Budget $100. No b...</p>
                                        <p><a href="#">C Programming</a>, <a href="#">Java</a>, <a href="#">C# Programming</a></p>
                                    </div>
                                </td>
                                <td>
                                    0
                                </td>
                                <td>
                                    Today<br/>6d 23h
                                </td>
                                <td>
                                    $30-$250
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .project-description h2 {
  font-weight: bold;
  margin: 0 0 10px;
}
</style>