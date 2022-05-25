<?php

use App\Helpers\base;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Todo;
use App\Models\TodoTitle;
use App\Models\House;
use App\Models\HouseTenant;
use App\Models\Announcement;
use App\Models\SOP;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use App\Models\TicketReply;

if (!function_exists('Check_User_house')) {
    function Check_User_house($house_id)
    {
        $user = Auth::user();

        if ($user->hasAnyRole('Super Admin')) {
            return 1;
        }
        $houseget = House::where('id', '=', $house_id)
            ->where('created_by', '=', $user->id)->get();

        // dd($houseget);

        if (count($houseget) < 1)
            return 0;
        else
            return 1;
    }
}

if (!function_exists('Check_User_tenant')) {
    function Check_User_tenant($tenant_id)
    {
        try {
            $user = Auth::user();
            $houseget = DB::table('house_tenants')
                ->join('houses', 'houses.id', '=', 'house_tenants.house_id')
                ->where('houses.created_by', $user->id)
                ->where('house_tenants.id', '=', $tenant_id)
                ->get();

            // dd($houseget);

            if (count($houseget) < 1)
                return 0;
            else
                return 1;
        } catch (Exception $e) {
            return 0;
        }
    }
}

if (!function_exists('Check_User_utility')) {
    function Check_User_utility($utility_id)
    {
        try {
            $user = Auth::user();
            $houseget = DB::table('house_utilities')
                ->join('houses', 'houses.id', '=', 'house_utilities.house_id')
                ->where('houses.created_by', $user->id)
                ->where('house_utilities.id', '=', $utility_id)
                ->get();

            // dd($houseget);

            if (count($houseget) < 1)
                return 0;
            else
                return 1;
        }

        //catch exception
        catch (Exception $e) {
            return 0;
        }
    }
}

if (!function_exists('Check_User_tax')) {
    function Check_User_tax($tax_id)
    {
        try {
            $user = Auth::user();
            $houseget = DB::table('house_taxes')
                ->join('houses', 'houses.id', '=', 'house_taxes.house_id')
                ->where('houses.created_by', $user->id)
                ->where('house_taxes.id', '=', $tax_id)
                ->get();

            // dd($houseget);

            if (count($houseget) < 1)
                return 0;
            else
                return 1;
        }

        //catch exception
        catch (Exception $e) {
            return 0;
        }
    }
}

if (!function_exists('Check_User_cost')) {
    function Check_User_cost($cost_id)
    {
        try {
            $user = Auth::user();
            $houseget = DB::table('house_costs')
                ->join('houses', 'houses.id', '=', 'house_costs.house_id')
                ->where('houses.created_by', $user->id)
                ->where('house_costs.id', '=', $cost_id)
                ->get();

            // dd($houseget);

            if (count($houseget) < 1)
                return 0;
            else
                return 1;
        }

        //catch exception
        catch (Exception $e) {
            return 0;
        }
    }
}

if (!function_exists('Check_User_doc')) {
    function Check_User_doc($doc_id)
    {
        try {
            $user = Auth::user();
            $houseget = DB::table('house_docs')
                ->join('houses', 'houses.id', '=', 'house_docs.house_id')
                ->where('houses.created_by', $user->id)
                ->where('house_docs.id', '=', $doc_id)
                ->get();

            // dd($houseget);

            if (count($houseget) < 1)
                return 0;
            else
                return 1;
        }

        //catch exception
        catch (Exception $e) {
            return 0;
        }
    }
}

if (!function_exists('Check_User_agg')) {
    function Check_User_agg($agg_id)
    {
        try {
            $user = Auth::user();
            $houseget = DB::table('house_agreements')
                ->join('houses', 'houses.id', '=', 'house_agreements.house_id')
                ->where('houses.created_by', $user->id)
                ->where('house_agreements.id', '=', $agg_id)
                ->get();

            // dd($houseget);

            if (count($houseget) < 1)
                return 0;
            else
                return 1;
        }

        //catch exception
        catch (Exception $e) {
            return 0;
        }
    }
}

if (!function_exists('Check_User_invoice')) {
    function Check_User_invoice($invoice_id)
    {
        try {
            $user = Auth::user();
            $houseget = DB::table('house_invoices')
                ->join('houses', 'houses.id', '=', 'house_invoices.house_id')
                ->where('houses.created_by', $user->id)
                ->where('house_invoices.id', '=', $invoice_id)
                ->get();

            // dd($houseget);

            if (count($houseget) < 1)
                return 0;
            else
                return 1;
        }

        //catch exception
        catch (Exception $e) {
            return 0;
        }
    }
}

if (!function_exists('Check_User_announcement')) {
    function Check_User_announcement($ann_id)
    {
        try {
            $user = Auth::user();
            $announcement = DB::table('announcements')
                ->where('announcements.created_by', $user->id)
                ->where('announcements.id', '=', $ann_id)
                ->get();

            // dd($announcement);

            if (count($announcement) < 1)
                return 0;
            else
                return 1;
        }

        //catch exception
        catch (Exception $e) {
            return 0;
        }
    }
}

if (!function_exists('get_nav_menu')) {
    function get_nav_menu($house_id, $active_index)
    {
        $user = Auth::user();

        if ($user->hasAnyRole('Admin')) {
            $nav_house = array(
                0 => array(
                    'pagename' => 'Maklumat rumah',
                    'pageurl' => route('house.edit', $house_id),
                    'is_active' => ''
                ),
                1 => array(
                    'pagename' => 'Dokumen',
                    'pageurl' => "/housedoc/$house_id",
                    'is_active' => ''
                ),
            );
        }else if ($user->hasAnyRole('Staf', 'Tenant')) {
            $nav_house = array(
                0 => array(
                    'pagename' => 'Maklumat rumah',
                    'pageurl' => route('house.edit', $house_id),
                    'is_active' => ''
                ),
                1 => array(
                    'pagename' => 'Perjanjian sewa',
                    'pageurl' => "/houseagreement/$house_id",
                    'is_active' => ''
                ),
            );
        } else {


            $nav_house = array(
                0 => array(
                    'pagename' => 'Maklumat Rumah',
                    'pageurl' => route('house.edit', $house_id),
                    'is_active' => ''
                ),
                1 => array(
                    'pagename' => 'Dokumen',
                    'pageurl' => "/housedoc/$house_id",
                    'is_active' => ''
                ),
                2 => array(
                    'pagename' => 'Perjanjian Sewa',
                    'pageurl' => "/houseagreement/$house_id",
                    'is_active' => ''
                ),
                3 => array(
                    'pagename' => 'Iklan/Video/Gambar',
                    'pageurl' => "/housemedia/$house_id",
                    'is_active' => ''
                ),
                4 => array(
                    'pagename' => 'Penyewa',
                    'pageurl' => "/housetenant/$house_id",
                    'is_active' => ''
                ),
                5 => array(
                    'pagename' => 'Utiliti',
                    'pageurl' => "/houseutility/$house_id",
                    'is_active' => ''
                ),

                6 => array(
                    'pagename' => 'Cukai',
                    'pageurl' => "/housetax/$house_id",
                    'is_active' => ''
                ),

                7 => array(
                    'pagename' => 'Kos',
                    'pageurl' => "/housecost/$house_id",
                    'is_active' => ''
                ),

                8 => array(
                    'pagename' => 'Invois / Resit',
                    'pageurl' => "/houseinvoice/$house_id",
                    'is_active' => ''
                ),

                // 9 => array(
                //     'pagename' => 'Resit',
                //     'pageurl' => "/housereceipt/$house_id",
                //     'is_active' => ''
                // )
            );
        }

        $nav_house[$active_index]['is_active'] = 'active';

        return $nav_house;
    }
}

    if (!function_exists('get_list_year')) {
        function get_list_year()
        {
            $min = 2020;
            $max = 2031;
            $array = [$max - $min];

            for ($i = 0; $i < $max - $min; $i++) {
                $array[$i] = $min + $i;
            }

            return $array;
        }
    }

    if (!function_exists('get_list_month')) {
        function get_list_month()
        {
            $min = 1;
            $max = 13;
            $array = [$max - $min];

            for ($i = 0; $i < $max - $min; $i++) {
                $array[$i] = $min + $i;
            }

            return $array;
        }
    }

    if (!function_exists('user_to_expired')) {
        function user_to_expired($days)
        {
            // $expDate = Carbon::now()->subDays(15);
            // $users = User::whereDate('date_expired', '<',$expDate)->get();

            // $users = User::whereRaw('DATEDIFF(date_expired,current_date) < 10')->get();

            $users = User::whereHas("roles", function($q){
                $q->where("name", "Owner");
           })
           ->whereRaw('DATEDIFF(date_expired,current_date) < ' . $days)
           ->get();

            return $users;
        }
    }

    if (!function_exists('tenant_to_expired')) {
        function tenant_to_expired($days)
        {
            // $expDate = Carbon::now()->subDays(15);
            // $users = User::whereDate('date_expired', '<',$expDate)->get();

            $user = Auth::user();

            $users = User::whereHas("roles", function($q){
                 $q->where("name", "Tenant");
            })
            ->whereRaw('DATEDIFF(date_expired,current_date) < ' . $days)
            ->where('created_by', $user->id)
            ->get();

            return $users;
        }
    }

    if (!function_exists('todolist')) {
        function todolist()
        {
            $todoLists = TodoTitle::selectRaw('todos.user_id, todo_titles.id, todo_titles.title, todos.tasks, todo_titles.created_at')
            ->join('todos', 'todoTitle_id', '=', 'todo_titles.id')
            ->where('todos.user_id', auth()->user()->id)
            ->where('todo_titles.readTitle', 0)
            ->groupByRaw('todo_titles.title')
            ->orderBy('id', 'DESC')
            ->get();

            $todoPending = Todo::query()
            ->where('todos.user_id', auth()->user()->id)
            ->with('task')
            ->where('tasks', '<>', NULL)
            ->where('completed', '=', 0)
            // ->groupByRaw('todo_titles.title')
            ->orderBy('id', 'DESC')
            ->get();

            $todoLists_pending = TodoTitle::selectRaw('todos.user_id, todo_titles.id, todo_titles.title, todos.tasks, todo_titles.created_at')
            ->join('todos', 'todoTitle_id', '=', 'todo_titles.id')
            ->where('todos.user_id', auth()->user()->id)
            ->where('todos.tasks', '<>', NULL)
            ->where('todos.completed', '=', 0)
            ->orderBy('id', 'DESC')
            ->get();

            return $todoLists_pending;
            // dd($todoLists_pending);
        }
    }

    if (!function_exists('new_announcements')) {
        function new_announcements($period_new)
        {
            $user = Auth::user();
            $announcements = [];


            // $expDate = Carbon::now()->subDays($period_new);

            $announcements = Announcement::select(
                'announcements.id',
                'announcements.title',
                'announcements.announcement_type',
                'announcements.announcement_date',
                'announcements.created_by',
                'announcements.created_at',
                'owner.name'
                )
                ->join('users as owner', 'owner.id', '=', 'announcements.created_by')
                ->join('users as tenant', 'tenant.created_by', '=', 'owner.id')
                ->join('announcement_receivers as ann_receivers', 'ann_receivers.announcement_id', '=', 'announcements.id')
                ->where('tenant.id', '=', $user->id)
                // ->where('announcements.announcement_date', '<=', $expDate)
                ->whereRaw(DB::raw("
                ABS(DATEDIFF(announcements.announcement_date,current_date)) < " . $period_new . " AND announcements.announcement_date <= current_date"
                ))
                ->get();
                // ->toSql();

                return $announcements;

        }

    }

    if (!function_exists('new_ticket')) {
        function new_ticket()
        {
            $user = Auth::user();

            if ($user->hasAnyRole('Owner')) {
                // $tickets = Ticket::with('images', 'parameterCategory', 'replies')
                // ->select('tickets.id', 'tickets.ticket_number','tickets.ticket_id', 'tickets.category_id', 'tickets.user_id', 'tickets.created_at', 'users.name', 'tickets.title', 'tickets.priority', 'tickets.message', 'tickets.status', 'houses.id as house_id','houses.address1', 'houses.address2', 'houses.poskod', 'houses.daerah', 'parameters.type_name as negeri')
                // ->join('house_tenants', 'house_tenants.tenant_user_id', '=', 'tickets.user_id')
                // ->join('users', 'users.id', '=', 'house_tenants.tenant_user_id')
                // ->join('houses', 'houses.id', '=', 'house_tenants.house_id')
                // ->join('parameters', 'parameters.type_id', '=', 'houses.negeri')
                // ->where('users.created_by', '=', $user->id)
                // ->where('tickets.status', '<>', 'Deraf')
                // ->has('replies', '=' , 0)
                // ->orderBy('tickets.created_at', 'DESC')
                // // ->withCount('replies')
                // ->toSql();
                // // ->get();

                $tickets = Ticket::with('images', 'parameterCategory', 'replies')
                ->select('tickets.id', 'tickets.ticket_number','tickets.ticket_id', 'tickets.category_id', 'tickets.user_id', 'tickets.created_at', 'users.name', 'tickets.title', 'tickets.priority', 'tickets.message', 'tickets.status')
                ->join('users', 'users.id', '=', 'tickets.user_id')
                ->where('users.created_by', '=', $user->id)
                ->where('tickets.status', '<>', 'Deraf')
                ->has('replies', '=' , 0)
                ->orderBy('tickets.created_at', 'DESC')
                // ->toSql();
                ->get();
            }else{
                $tickets = null;
            }
            // dd($tickets);
            return $tickets;

        }

    }

    if (!function_exists('new_sop')) {
        function new_sop($period_new)
        {
            $user = Auth::user();
            $sops = [];


            // $expDate = Carbon::now()->subDays($period_new);

            $sops = SOP::select(
                's_o_p_s.id',
                's_o_p_s.sop_name',
                's_o_p_s.created_by',
                's_o_p_s.created_at',
                'staf.name'
                )
                ->join('users as staf', 'staf.id', '=', 's_o_p_s.created_by')
                // ->where('announcements.announcement_date', '<=', $expDate)
                ->whereRaw(DB::raw("ABS(DATEDIFF(s_o_p_s.created_at,current_date)) < " . $period_new))
                ->get();
                // ->toSql();

                return $sops;

        }

    }

    // for tenant notification
    if (!function_exists('new_ticketreply')) {
        function new_ticketreply($period_new)
        {
            $user = Auth::user();
            $ticket_replies = [];


            // $expDate = Carbon::now()->subDays($period_new);

            $ticket_replies = TicketReply::select(
                'ticket_replies.id',
                'ticket_replies.reply',
                'ticket_replies.reply_by',
                'ticket_replies.created_at',
                'owner.name',
                'tickets.ticket_number',
                'tickets.title'
                )
                ->join('users as owner', 'owner.id', '=', 'ticket_replies.reply_by')
                ->join('tickets', 'tickets.ticket_id', '=', 'ticket_replies.ticket_id')
                // ->where('announcements.announcement_date', '<=', $expDate)
                ->where('tickets.user_id', $user->id)
                ->whereRaw(DB::raw("ABS(DATEDIFF(ticket_replies.created_at,current_date)) < " . $period_new))
                ->get();
                // ->toSql();

                return $ticket_replies;

        }

    }