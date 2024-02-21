<?php
get_header();
?>
<div id="page-body" class="d-flex">
    <?php
    get_sidebar();
    ?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h5 class="m-0 ">Danh sách thành viên</h5>
                </div>
            </div>
            <div class="card-body">
                <p class="text-success">có <?php echo $total_row ?> thành viên trong hệ thống</p>
                <div class="form-action form-inline py-3">
                    <form action="" method="POST">
                        <input type="text" class="form-control form-search" name="search" placeholder="Tìm kiếm">
                        <input type="submit" name="btn_search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                    <select class="form-control mr-1" id="">
                        <option>Chọn</option>
                        <option>Xoá tất cả thành viên</option>
                    </select>
                </div>
                <?php if (!empty($listMember)) {
                ?>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkall">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Quyền</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody class="border border-info">
                            <?php
                            $temp = 0;
                            foreach ($listMember as $user) {
                                $temp++;
                            ?>
                                <tr>
                                    <td>
                                        <input type="checkbox">
                                    </td>
                                    <th scope="row"><?php echo $temp; ?></th>
                                    <td><?php echo $user['fullname']; ?></td>
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><?php echo $user['permission']; ?></td>
                                    <td><?php if (!empty($user['created_date'])) echo date('d/m/Y', $user['created_date']); ?></td>
                                    <td>
                                        <a href="<?php echo "?mod=users&controller=team&action=update&user_id={$user['user_id']}"; ?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo "?mod=users&controller=team&action=delete&user_id={$user['user_id']}"; ?>" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                        <a href="<?php echo "?mod=users&controller=team&action=reset&user_id={$user['user_id']}"; ?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="ChangePass"><i class="fa fa-key"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php }  ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>