<?php

return [
    'models' => [


        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you want to use as a Role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'jobtracking' => \Upbase\Jobtracking\Models\JobTracking::class

    ],
   'table_name' => 'job_tracking'
];
