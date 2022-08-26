
<?php echo view('Common/header.php'); ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body view_page">
                <div class="row-6 table-responsive">
                    <h4 class="card-title">View Page     </h4>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="col-3">
                                    <h5>Category</5>
                                </td>
                                <td class="col-1">:</td>
                                <td class="col-8">
                                    <?php echo !empty($category_info['data'][0]['username']) ? $category_info['data'][0]['username'] : ''; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Image</h5>
                                </td>
                                <td>:</td>
                                <td>
                                   
                                    <img id="blah" src="<?php
                                    
                                  
                                    
                                    echo ('http://localhost/projectt/public/uploads/' . $category_info['data'][0]['category_image']) ? ('http://localhost/projectt/public/uploads/' . $category_info['data'][0]['category_image']) : ''; ?>" style="width: 150px;" height="100px" />
                                </td>
                            </tr>
                            <tr>
                                <td class="col-3">
                                    <h5>Email</5>
                                </td>
                                <td class="col-1">:</td>
                                <td class="col-8">
                                    <?php echo !empty($category_info['data'][0]['email']) ? $category_info['data'][0]['email'] : ''; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-3">
                                    <h5>Contact</5>
                                </td>
                                <td class="col-1">:</td>
                                <td class="col-8">
                                    <?php echo !empty($category_info['data'][0]['contact']) ? $category_info['data'][0]['contact'] : ''; ?>
                                </td>
                            </tr>
                              <tr>
                                <td class="col-3">
                                    <h5>Qualification</5>
                                </td>
                                <td class="col-1">:</td>
                                <td class="col-8">
                                    <?php echo !empty($category_info['data'][0]['languages']) ? $category_info['data'][0]['languages'] : ''; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>State </h5>
                                </td>
                                <td class="col-1">:</td>
                                <td>
                                    <div id="CategoryDescription" class="form-control>">
                                        <?php echo !empty($category_info['data'][0]['state_id']) ? $category_info['data'][0]['state_id'] : ''; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-3">
                                    <h5>City</5>
                                </td>
                                <td class="col-1">:</td>
                                <td class="col-8">
                                    <?php echo !empty($category_info['data'][0]['city_id']) ? $category_info['data'][0]['city_id'] : ''; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


