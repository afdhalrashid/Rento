<?php

namespace App\Providers;

use App\Helpers\base;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use  App\Models\Parameter as Parameter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);



        // dd($global_houseutility_types);

        view()->composer(
            '*',
            function ($view) {

                $global_all_to_expired =[];
                $days_before_expired = 30;
                $todoLists_pending = [];
                $new_announcement = [];
                $new_tickets = [];
                $new_sops = [];
                $new_ticketreplies = [];

                if (Auth::check()) {
                        // The user is logged in...
                        $todoLists_pending = todolist();
                        $new_announcement = new_announcements(3);
                        $new_tickets = new_ticket();
                        $new_sops = new_sop(3);
                        $new_ticketreplies = new_ticketreply(5);
                        // dd(count(array($new_announcement)));
                        // dd($new_tickets);
                        $global_user_to_expired = user_to_expired($days_before_expired);
                        $global_tenant_to_expired = tenant_to_expired($days_before_expired);

                        if(Auth::user()->hasRole('Staf')){
                            $global_all_to_expired = $global_user_to_expired ;
                        }

                        if(Auth::user()->hasRole('Owner')){
                            $global_all_to_expired = $global_tenant_to_expired ;
                        }
                        // dd($global_all_to_expired);


                }

                $global_states = Parameter::where('parameter_name', 'state')
                    ->orderBy('type_id')
                    ->get();

                $global_housetypes = Parameter::where('parameter_name', 'housetype')
                    ->orderBy('type_id')
                    ->get();

                $global_races = Parameter::where('parameter_name', 'race')
                    ->orderBy('type_id')
                    ->get();
                // dd($global_states);

                $global_houseutility_types = Parameter::where(
                    'parameter_name',
                    'utility_type'
                )
                    ->orderBy('type_id')
                    ->get();

                $global_housetax_types = Parameter::where(
                    'parameter_name',
                    'tax_type'
                )
                    ->orderBy('type_id')
                    ->get();

                $global_housecost_types = Parameter::where(
                    'parameter_name',
                    'cost_type'
                )
                    ->orderBy('type_id')
                    ->get();

                $global_ticketcategory_types = Parameter::where(
                    'parameter_name',
                    'ticket_category'
                )
                    ->orderBy('type_id')
                    ->get();

                // $global_doc_types = [
                //     [
                //         'type_id' => 'SPA',
                //         'type_name' => 'SPA',
                //     ],
                //     [
                //         'type_id' => 'Valuation',
                //         'type_name' => 'Valuation',
                //     ],
                //     [
                //         'type_id' => 'Loan',
                //         'type_name' => 'Loan',
                //     ],

                // ];

                $global_doc_types = collect(
                    [
                        (object) [
                            'type_id' => 'SPA',
                            'type_name' => 'SPA'
                        ],
                        (object) [
                            'type_id' => 'Valuation',
                            'type_name' => 'Valuation'
                        ],
                        (object) [
                            'type_id' => 'Loan',
                            'type_name' => 'Loan'
                        ]
                    ]
                );

                $global_agg_types = collect(
                    [
                        (object) [
                            'type_id' => 'Agreement Stamping',
                            'type_name' => 'Agreement Stamping'
                        ]
                    ]
                );

                $global_ticket_status = collect(
                    [
                        (object) [
                            'type_id' => 'Dibuka',
                            'type_name' => 'Dibuka'
                        ],
                        (object) [
                            'type_id' => 'Sedang diproses',
                            'type_name' => 'Sedang diproses'
                        ],
                        (object) [
                            'type_id' => 'Selesai',
                            'type_name' => 'Selesai'
                        ]
                    ]
                );

                $global_announcement_type = collect(
                    [
                        (object) [
                            'type_id' => 'Isu Semasa',
                            'type_name' => 'Isu Semasa'
                        ],
                        (object) [
                            'type_id' => 'Peraturan Sewaan',
                            'type_name' => 'Peraturan Sewaan'
                        ],
                        (object) [
                            'type_id' => 'Lain-lain',
                            'type_name' => 'Lain-lain'
                        ]
                    ]
                );

                $global_sop_type = collect(
                    [
                        (object) [
                            'type_id' => 'Sebelum Penyewa Masuk',
                            'type_name' => 'Sebelum Penyewa Masuk'
                        ],
                        (object) [
                            'type_id' => 'Semasa Proses Menyewa',
                            'type_name' => 'Semasa Proses Menyewa'
                        ],
                        (object) [
                            'type_id' => 'Selepas Penyewa Keluar',
                            'type_name' => 'Selepas Penyewa Keluar'
                        ]
                    ]
                );

                $global_vehicle_type = collect(
                    [
                        (object) [
                            'type_id' => 'Kereta',
                            'type_name' => 'Kereta'
                        ],
                        (object) [
                            'type_id' => 'Motosikal',
                            'type_name' => 'Motosikal'
                        ],
                        (object) [
                            'type_id' => 'Lori',
                            'type_name' => 'Lori'
                        ],
                        (object) [
                            'type_id' => 'Bas',
                            'type_name' => 'Bas'
                        ],
                        (object) [
                            'type_id' => 'Pickup',
                            'type_name' => 'Pickup'
                        ],
                        (object) [
                            'type_id' => 'MPV',
                            'type_name' => 'MPV'
                        ],
                    ]
                );

                $global_bankname = collect(
                    [
                        (object) [
                            'type_id' => 'Bank Islam',
                            'type_name' => 'Bank Islam'
                        ],
                        (object) [
                            'type_id' => 'Bank Rakyat',
                            'type_name' => 'Bank Rakyat'
                        ],(object) [
                            'type_id' => 'Maybank',
                            'type_name' => 'Maybank'
                        ],(object) [
                            'type_id' => 'CIMB ',
                            'type_name' => 'CIMB'
                        ],(object) [
                            'type_id' => 'RHB',
                            'type_name' => 'RHB'
                        ],
                    ]
                );

                $global_utility_name = collect(
                    [
                        (object) [
                            'type_id' => 'Bil Internet',
                            'type_name' => 'Bil Internet'
                        ],
                        (object) [
                            'type_id' => 'Bil Astro',
                            'type_name' => 'Bil Astro'
                        ],(object) [
                            'type_id' => 'Bil Elektrik',
                            'type_name' => 'Bil Elektrik'
                        ],(object) [
                            'type_id' => 'Bil Air',
                            'type_name' => 'Bil Air'
                        ],(object) [
                            'type_id' => 'Bil Kumbahan',
                            'type_name' => 'Bil Kumbahan'
                        ],(object) [
                            'type_id' => 'Bil Penyelenggaraan',
                            'type_name' => 'Bil Penyelenggaraan'
                        ],(object) [
                            'type_id' => 'Bil Lain-lain',
                            'type_name' => 'Bil Lain-lain'
                        ],(object) [
                            'type_id' => 'Bayaran Hutang Rumah',
                            'type_name' => 'Bayaran Hutang Rumah'
                        ],(object) [
                            'type_id' => 'Cukai Taksiran',
                            'type_name' => 'Cukai Taksiran'
                        ],(object) [
                            'type_id' => 'Cukai Petak',
                            'type_name' => 'Cukai Petak'
                        ],(object) [
                            'type_id' => 'Cukai Tanah',
                            'type_name' => 'Cukai Tanah'
                        ],(object) [
                            'type_id' => 'Insurans Kebakaran',
                            'type_name' => 'Insurans Kebakaran'
                        ],(object) [
                            'type_id' => 'Insurans Lain-lain',
                            'type_name' => 'Insurans Lain-lain'
                        ],
                    ]
                );


                // dd($global_vehicle_type);
                // dd($global_doc_types);

                // foreach ($global_doc_types as $doc_types) {
                //     echo $doc_types;
                // }




                // variable to be access in VIEW
                $view->with(
                    compact(
                        'global_all_to_expired',
                        'days_before_expired',
                        'todoLists_pending',
                        'new_announcement',
                        'new_tickets',
                        'new_sops',
                        'new_ticketreplies',
                        'global_states',
                        'global_housetypes',
                        'global_races',
                        'global_houseutility_types',
                        'global_housetax_types',
                        'global_housetax_types',
                        'global_housecost_types',
                        'global_ticketcategory_types',
                        'global_doc_types',
                        'global_agg_types',
                        'global_ticket_status',
                        'global_announcement_type',
                        'global_sop_type',
                        'global_vehicle_type',
                        'global_bankname',
                        'global_utility_name',
                    )
                );
            }
        );
    }
}