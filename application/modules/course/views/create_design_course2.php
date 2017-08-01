<?php echo $header; ?>


<script>
	$(document).ready(function() {
        var sectionTemplate = '';
        var unitTemplate = '<div class="dc-unit-info dc-course-item" >'+
                                '<div class="dc-content-title">'+
                                    '<h5 class="xsm black">Unit 1 : title of unit</h5>'+
                                    '<div class="course-region-tool">'+
                                        '<a href="#" class="delete" title="delete"><i class="icon md-recycle"></i></a>'+
                                        '<a href="#" class="save" title="save"><i class="fa fa-save"></i></a>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="unit-body dc-item-body">'+
                                    '<table class="tb-course">'+
                                        '<tbody>'+
                                            '<tr class="tb-unit-title">'+
                                                '<td class="label-info"><label for="">Title</label></td>'+
                                                '<td class="td-form-item">'+
                                                    '<div class="form-item"><input type="text" name="title"></div>'+
                                                '</td>'+
                                            '</tr>'+
                                            '<tr class="tr-file">'+
                                                '<td class="label-info"><label for="">Reference file</label></td>'+
                                                '<td class="td-form-item">'+
                                                    '<div class="upload-image up-file">'+
                                                        '<a href="#"><i class="icon md-upload"></i></a>'+
                                                        '<input type="file" name="content-file"><span class="size-file"></span>'+
                                                        '&nbsp;&nbsp;&nbsp;'+
                                                        '<input type="checkbox" id="make" name="is_free">'+
                                                        '<label for="make">'+
                                                            '<i class="icon-checkbox icon md-check-1"></i> Make this Unit as Free'+
                                                        '</label>'+
                                                    '</div>'+
                                                '</td>'+
                                            '</tr>'+
                                        '</tbody>'+
                                    '</table>'+
                                '</div>'+
                            '</div>';

        function addUnit() {
            $("#dc-section-body-1").append(unitTemplate);
        }
    });
</script>

<!-- CREATE COURSE CONTENT -->
<section id="create-course-section" class="create-course-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="create-course-sidebar">
                    <ul class="list-bar">
                        <li><span class="count">1</span>Basic Information</li>
                        <li class="active"><span class="count">2</span>Design Course</li>
                        <li><span class="count">3</span>Publish Course</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                <div class="create-course-content">

                    <!-- COURSE BANNER -->
                    <ul class="design-course-tabs" role="tablist">
                        <li class="active">
                            <a href="#design-outline" role="tab" data-toggle="tab"><i class="icon md-list"></i>Outline</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- DESIGN OUTLINE -->
                        <div class="tab-pane fade in active" id="design-outline">
                            
                            <!-- SECTIONS -->
                            <div class="dc-sections">
                                <!-- DC SECTION INFO -->
                                <div class="dc-section-info">
                                    <div class="title-section">
                                        <h4 class="xsm" id="section-title">Section 1 : <span contenteditable="true">This is title of the section</span></h4>
                                        <div class="form-item" id="section-title-form" style="display:none">
                                            <input type="text" name="title"> 
                                            <button type="button" class="btn btn-success btn-sm" onClick="saveTitle()">Save</button>
                                            <button type="button" class="btn btn-default btn-sm" onClick="cancelEditTitle()">Cancel</button>
                                        </div>
                                        <div class="course-region-tool">
                                            <a class="edit" title="edit" onClick="editTitle()" style="cursor: pointer; cursor: hand;"><i class="icon md-pencil"></i></a>
                                            <a href="#" class="delete" title="delete"><i class="icon md-recycle"></i></a>
                                            <a href="#" class="toggle-section active"><i class="fa fa-caret-right"></i></a>
                                        </div>
                                    </div>

                                    <script>
                                        function editTitle() {
                                            $("#section-title").hide();
                                            $("#section-title-form").show();
                                        }
                                        function cancelEditTitle() {
                                            $("#section-title").show();
                                            $("#section-title-form").hide();
                                        }
                                        
                                    </script>

                                    <!-- DC SECTION BODY -->
                                    <div class="dc-section-body" id="dc-section-body-1">

                                        <!-- DC UNIT -->                                        
                                		<div class="dc-unit-info dc-course-item" >
                                            <div class="dc-content-title">
                                                <h5 class="xsm black">Unit 1 : title of unit</h5>
                                                <div class="course-region-tool">
                                                    <a href="#" class="edit" title="edit"><i class="icon md-pencil"></i></a>
                                                    <a href="#" class="delete" title="delete"><i class="icon md-recycle"></i></a>
                                                </div>
                                            </div>

                                            <div class="unit-body dc-item-body">
                                                <table class="tb-course">
                                                    <tbody>
                                                        <tr class="tb-unit-title">
                                                            <td class="label-info">
                                                                <label for="">Title</label>
                                                            </td>
                                                            <td class="td-form-item">
                                                                <div class="form-item">
                                                                    <input type="text" name="title">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="tr-file">
                                                            <td class="label-info">
                                                                <label for="">Reference file</label>
                                                            </td>
                                                            <td class="td-form-item">
                                                            	<div class="upload-image up-file">
    					                                            <a href="#"><i class="icon md-upload"></i></a>
    					                                            <input type="file" name="content-file">
    					                                            <span class="size-file"></span>
                                                                    &nbsp;&nbsp;&nbsp;
                                                                    <input type="checkbox" id="make" name="is_free">
                                                                    <label for="make">
                                                                        <i class="icon-checkbox icon md-check-1"></i>
                                                                        Make this Unit as Free
                                                                    </label>
    					                                        </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                
                                            </div>
                                        </div>
                                        <!-- END / DC UNIT -->
                                    </div>
                                    <ul class="dc-btn">
                                        <li>
                                            <a href="#" class="mc-btn-3 btn-style-7" onClick="addUnit()"><i class="icon md-plus"></i>Add Unit</a>
                                        </li>
                                    </ul>
                                    <!-- END / DC SECTION BODY -->

                                </div>
                                <!-- END / DC SECTION INFO -->

                                <!-- BUTTON ADD AND POPUP SECTION -->
                                <!--
                                <div class="add-section">
                                    <a href="#addsection" class="mc-btn-3 btn-style-1 popup-with-zoom-anim"><i class="icon md-plus"></i>Add Section</a>
                                    <div id="addsection" class="design-course-popup pp-add-section zoom-anim-dialog mfp-hide">
                                        <label for="">Section title</label>
                                        <div class="form-item">
                                            <input type="text">
                                        </div>
                                        <div class="pp-footer">
                                            <input type="submit" class="mc-btn-3 btn-style-1" value="Save Section">
                                            <a href="#" class="cancel mc-btn-3 btn-style-5">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            	-->
                                <!-- END / BUTTON ADD AND POPUP SECTION -->

                            </div>
                            <!-- END / SECTIONS -->                            
                            
                        </div>
                        <!-- END / DESIGN OUTLINE -->
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END / CREATE COURSE CONTENT -->

<?php echo $footer; ?>