<?php
    $logo=asset(Storage::url('uploads/logo/'));
       $company_favicon=Utility::getValByName('company_favicon');
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title><?php echo $__env->yieldContent('page-title'); ?> - <?php echo e((Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'CRMGo')); ?></title>
    <link rel="icon" href="<?php echo e($logo.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon:'favicon.png')); ?>" type="image" sizes="16x16">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/nucleo/css/nucleo.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')); ?>" type="text/css">
    <link href="<?php echo e(asset('assets/module/css/select2.min.css')); ?>" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/fullcalendar/dist/fullcalendar.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')); ?>">


    <link rel="stylesheet" href="<?php echo e(asset('assets/css/argon.css?v=1.1.0')); ?> " type="text/css">
    <link href="<?php echo e(asset('assets/module/bootstrap-toastr/toastr.min.css')); ?>" rel="stylesheet" type="text/css"/>

    <?php echo $__env->yieldPushContent('css-page'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/module/css/custom.css')); ?> " type="text/css">

</head>
<?php /**PATH C:\wamp64\www\products-temp\growcrm\resources\views/partials/admin/head.blade.php ENDPATH**/ ?>