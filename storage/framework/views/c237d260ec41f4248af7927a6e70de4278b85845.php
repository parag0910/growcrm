<?php
    $profile=asset(Storage::url('uploads/avatar'));
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('User')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <h6 class="h2 d-inline-block mb-0"><?php echo e(__('User')); ?></h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('User')); ?></li>
        </ol>
    </nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h2 class="h3 mb-0"><?php echo e(__('Manage Users')); ?></h2>
                            </div>
                            <div class="col-auto">
                                <a href="#" data-url="<?php echo e(route('user.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New User')); ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="card card-profile">
                        <div class="bg-profile"></div>
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="#">
                                        <img src="<?php echo e(!empty($user->avatar)?$profile.'/'.$user->avatar:$profile.'/avatar.png'); ?>" class="rounded-circle">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                            <div class="d-flex justify-content-between">
                                <a href="#" class="table-action" data-url="<?php echo e(route('user.edit',$user->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit User')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                    <i class="far fa-edit"></i>
                                </a>
                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id],'id'=>'delete-form-'.$user->id]); ?>

                                <?php echo Form::close(); ?>


                                <a href="#!" class="table-action table-action-delete float-right" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-<?php echo e($user->id); ?>').submit();">
                                    <i class="fas fa-trash"></i>
                                </a>

                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col">
                                    <div class="card-profile-stats d-flex justify-content-center">
                                        <div>
                                            <span class="heading"><?php echo e($user->countEmployees($user->id)); ?></span>
                                            <span class="description"><?php echo e(__('Employees')); ?></span>
                                        </div>
                                        <div>
                                            <span class="heading"><?php echo e($user->countClients($user->id)); ?></span>
                                            <span class="description"><?php echo e(__('Clients')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h5 class="h3">
                                    <?php echo e($user->name); ?>

                                </h5>
                                <div class="h5 font-weight-300">
                                    <?php echo e($user->type); ?>

                                </div>
                                <div class="h5 font-weight-300">
                                    <?php echo e($user->email); ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="text-left mb-3">
                                        <b class="text-primary font-style"><?php echo e(!empty($user->currentPlan)?$user->currentPlan->name:''); ?></b>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="text-right mb-3">
                                        <a href="#" class="btn btn-primary btn-sm" data-url="<?php echo e(route('plan.upgrade',$user->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Upgrade Plan')); ?>"><?php echo e(__('Upgrade Plan')); ?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-left mb-3">
                                        <p class="font-style"><?php echo e(__('Plan Expired : ')); ?> <?php echo e(!empty($user->plan_expire_date) ? \Auth::user()->dateFormat($user->plan_expire_date):'Unlimited'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\products-temp\growcrm\resources\views/user/index.blade.php ENDPATH**/ ?>