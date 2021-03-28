<?php $__env->startPush('script-page'); ?>
    <script>
        var SalesChart = (function () {
            var $chart = $('#chart-sales');

            function init($this) {
                var salesChart = new Chart($this, {
                    type: 'line',
                    options: {
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    color: Charts.colors.gray[700],
                                    zeroLineColor: Charts.colors.gray[700]
                                },
                                ticks: {}
                            }]
                        }
                    },
                    data: {
                        labels: <?php echo json_encode($chartData['label']); ?>,
                        datasets: [{
                            label: "<?php echo e(__('Order')); ?>",
                            data: <?php echo json_encode($chartData['data']); ?>

                        }]
                    }
                });

                $this.data('chart', salesChart);

            };

            if ($chart.length) {
                init($chart);
            }

        })();
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <h6 class="h2 d-inline-block mb-0"><?php echo e(__('Dashboard')); ?></h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links">
            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#"><?php echo e(__('Dashboard')); ?></a></li>
        </ol>
    </nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-md-4">
                <div class="card bg-gradient-primary border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0 text-white"><?php echo e(__('TOTAL USERS')); ?></h5>
                                        <span class="h2 font-weight-bold mb-0 text-white"><?php echo e($user->total_user); ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="ni ni-single-02"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-0">
                                </div>
                                <div class="progreess-status mt-2">
                                    <span><?php echo e(__('PAID USERS')); ?> :</span>
                                    <span><?php echo e($user['total_paid_user']); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="card bg-gradient-info border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0 text-white"><?php echo e(__('TOTAL ORDERS')); ?></h5>
                                        <span class="h2 font-weight-bold mb-0 text-white"><?php echo e($user->total_orders); ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="ni ni-cart"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-0">
                                </div>
                                <div class="progreess-status mt-2">
                                    <span><?php echo e(__('TOTAL ORDER AMOUNT')); ?> :</span>
                                    <span><?php echo e(\Auth::user()->priceFormat($user['total_orders_price'])); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="card bg-gradient-danger border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0 text-white"><?php echo e(__('TOTAL PLANS')); ?></h5>
                                        <span class="h2 font-weight-bold mb-0 text-white"><?php echo e($user['total_plan']); ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="ni ni-money-coins"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-0">
                                </div>
                                <div class="progreess-status mt-2">
                                    <span><?php echo e(__('MOST PURCHASE PLAN')); ?> :</span>
                                    <span><?php echo e($user['most_purchese_plan']); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card bg-default">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="h3 text-white mb-0"><?php echo e(__('Recent Order')); ?></h5>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="chart-sales" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\products-temp\growcrm\resources\views/dashboard/super_admin.blade.php ENDPATH**/ ?>