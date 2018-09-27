<?php

use App\Models\Plans;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'Free',
                'stripe_id_m' => null,
                'stripe_id_y' => null,
                'mercadopago_id_m' => null,
                'mercadopago_id_y' => null,
                'price_m' => 0,
                'price_y' => 0,
                'profile' => 1,
                'social' => 1,
                'agended' => 5,
                'feed' => 1,
                'automatic' => 8,
                'whitelist' => false,
                'unfollowall' => false,
                'ranking' => false,
                'user_id' => null,
            ],
            [
                'name' => 'Personal',
                'stripe_id_m' => 'plan_DaBlBpFbXyZTWF',
                'stripe_id_y' => 'plan_DeT4bUeEcg4v2t',
                'mercadopago_id_m' => null,
                'mercadopago_id_y' => null,
                'price_m' => 3,
                'price_y' => 30,
                'profile' => 1,
                'social' => 1,
                'agended' => 20,
                'feed' => 5,
                'automatic' => 20,
                'whitelist' => true,
                'unfollowall' => true,
                'ranking' => false,
                'user_id' => null,
            ],
            [
                'name' => 'Professional',
                'stripe_id_m' => 'plan_DaBmToIJqSQqqC',
                'stripe_id_y' => 'plan_DeT5wM2n080nkM',
                'mercadopago_id_m' => null,
                'mercadopago_id_y' => null,
                'price_m' => 5,
                'price_y' => 50,
                'profile' => 1,
                'social' => 5,
                'agended' => 50,
                'feed' => 10,
                'automatic' => 50,
                'whitelist' => true,
                'unfollowall' => true,
                'ranking' => false,
                'user_id' => null,
            ],
            [
                'name' => 'Community',
                'stripe_id_m' => 'plan_DeT3zGuJycZbOl',
                'stripe_id_y' => 'plan_DeT5SfpC26ISal',
                'mercadopago_id_m' => null,
                'mercadopago_id_y' => null,
                'price_m' => 15,
                'price_y' => 150,
                'profile' => 3,
                'social' => 15,
                'agended' => 999,
                'feed' => 999,
                'automatic' => 150,
                'whitelist' => true,
                'unfollowall' => true,
                'ranking' => true,
                'user_id' => null,
            ],

        ];

        foreach ($plans as $plan) {
            $newPlan = Plans::where('name', '=', $plan['name'])->first();
            if ($newPlan === null) {
                $newPlan = Plans::create([
                    'name' => $plan['name'],
                    'stripe_id_m' => $plan['stripe_id_m'],
                    'stripe_id_y' => $plan['stripe_id_y'],
                    'mercadopago_id_m' => $plan['mercadopago_id_m'],
                    'mercadopago_id_y' => $plan['mercadopago_id_y'],
                    'price_m' => $plan['price_m'],
                    'price_y' => $plan['price_y'],
                    'profile' => $plan['profile'],
                    'social' => $plan['social'],
                    'agended' => $plan['agended'],
                    'feed' => $plan['feed'],
                    'automatic' => $plan['automatic'],
                    'whitelist' => $plan['whitelist'],
                    'unfollowall' => $plan['unfollowall'],
                    'ranking' => $plan['ranking'],
                    'user_id' => $plan['user_id'],
                ]);
                $newPlan->save();

            }
        }

    }
}
