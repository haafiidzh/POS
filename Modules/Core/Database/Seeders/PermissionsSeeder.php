<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
    '* Run' the database seeds.,
     *
     * @return void
     */
    public function run()
    {

        foreach (array_keys($this->permissions()) as $permission) {
            // Gunakan firstOrCreate untuk menghindari duplikasi
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'web'],
                ['created_at' => now()->toDateTimeString(), 'updated_at' => now()->toDateTimeString()]
            );
        }
    }

    /**
     * Generate permission datas
     *
     * @return array
     */
    public function permissions()
    {
        return [
            # Dashboard

            'read.dashboard' => ['Developer', 'Super Admin', 'Admin', 'Course Admin'],

            # Order

            'read.order' => ['Developer', 'Super Admin', 'Admin'],
            'update.order' => ['Developer', 'Super Admin', 'Admin'],
            'export.order' => ['Developer', 'Super Admin', 'Admin'],
            'extra.order' => ['Developer', 'Super Admin', 'Admin'],

            # Guest Message

            'read.guest_message' => ['Developer', 'Super Admin', 'Admin'],
            'create.guest_message' => ['Developer', 'Super Admin', 'Admin'],
            'update.guest_message' => ['Developer', 'Super Admin', 'Admin'],
            'delete.guest_message' => ['Developer', 'Super Admin'],

            # Customer

            ## Listing

            'read.customer' => ['Developer', 'Super Admin', 'Admin', 'Course Admin'],
            'create.customer' => ['Developer', 'Super Admin'],
            'update.customer' => ['Developer', 'Super Admin', 'Admin'],
            'delete.customer' => ['Developer', 'Super Admin'],
            'import.customer' => ['Developer', 'Super Admin'],
            'export.customer' => ['Developer', 'Super Admin', 'Admin'],

            ## Course

            'read.customer-course' => ['Developer', 'Super Admin', 'Admin', 'Course Admin'],
            'create.customer-course' => ['Developer', 'Super Admin', 'Admin'],
            'update.customer-course' => ['Developer', 'Super Admin', 'Admin'],
            'delete.customer-course' => ['Developer', 'Super Admin'],

            ## Complete Course

            'extra.customer-complete_course' => ['Developer', 'Super Admin'],

            # Course

            ## Listing

            'read.course' => ['Developer', 'Super Admin', 'Admin', 'Course Admin'],
            'create.course' => ['Developer', 'Super Admin', 'Course Admin'],
            'update.course' => ['Developer', 'Super Admin', 'Course Admin'],
            'delete.course' => ['Developer', 'Super Admin', 'Course Admin'],
            'publish.course' => ['Developer', 'Super Admin'],
            'export.course' => ['Developer', 'Super Admin', 'Course Admin'],

            ## Category

            'read.course-category' => ['Developer', 'Super Admin', 'Admin', 'Course Admin'],
            'create.course-category' => ['Developer', 'Super Admin'],
            'update.course-category' => ['Developer', 'Super Admin'],
            'delete.course-category' => ['Developer', 'Super Admin'],
            'publish.course-category' => ['Developer', 'Super Admin'],

            ## Type

            'read.course-type' => ['Developer', 'Super Admin', 'Admin', 'Course Admin'],
            'create.course-type' => ['Developer', 'Super Admin'],
            'update.course-type' => ['Developer', 'Super Admin'],
            'delete.course-type' => ['Developer', 'Super Admin'],
            'publish.course-type' => ['Developer', 'Super Admin'],

            ## Review

            'read.course-review' => ['Developer', 'Super Admin', 'Admin', 'Course Admin'],
            'create.course-review' => ['Developer'],
            'update.course-review' => ['Developer', 'Super Admin', 'Course Admin'],
            'delete.course-review' => ['Developer', 'Super Admin', 'Admin', 'Course Admin'],

            # Ecommerce Setting

            ## Coupon

            'read.ecommerce_setting-coupon' => ['Developer', 'Super Admin', 'Admin'],
            'create.ecommerce_setting-coupon' => ['Developer', 'Super Admin', 'Admin'],
            'update.ecommerce_setting-coupon' => ['Developer', 'Super Admin', 'Admin'],
            'delete.ecommerce_setting-coupon' => ['Developer', 'Super Admin', 'Admin'],
            'publish.ecommerce_setting-coupon' => ['Developer', 'Super Admin'],

            ## Fees

            'read.ecommerce_setting-fees' => ['Developer', 'Super Admin', 'Admin'],
            'create.ecommerce_setting-fees' => ['Developer'],
            'update.ecommerce_setting-fees' => ['Developer', 'Super Admin'],
            'delete.ecommerce_setting-fees' => ['Developer'],

            # Slider

            'read.slider' => ['Developer', 'Super Admin', 'Admin'],
            'create.slider' => ['Developer', 'Super Admin', 'Admin'],
            'update.slider' => ['Developer', 'Super Admin', 'Admin'],
            'delete.slider' => ['Developer', 'Super Admin', 'Admin'],
            'publish.slider' => ['Developer', 'Super Admin'],

            # Article

            ## Listing

            'read.article' => ['Developer', 'Super Admin', 'Admin'],
            'create.article' => ['Developer', 'Super Admin', 'Admin'],
            'update.article' => ['Developer', 'Super Admin', 'Admin'],
            'delete.article' => ['Developer', 'Super Admin', 'Admin'],
            'publish.article' => ['Developer', 'Super Admin'],

            ## Category

            'read.article-category' => ['Developer', 'Super Admin', 'Admin'],
            'create.article-category' => ['Developer', 'Super Admin', 'Admin'],
            'update.article-category' => ['Developer', 'Super Admin', 'Admin'],
            'delete.article-category' => ['Developer', 'Super Admin', 'Admin'],
            'publish.article-category' => ['Developer', 'Super Admin'],

            ## Visitor Web


            'read.visitor' => ['Developer', 'Super Admin', 'Admin'],



            ## Listing

            'read.product' => ['Developer', 'Super Admin', 'Admin'],
            'create.product' => ['Developer', 'Super Admin', 'Admin'],
            'update.product' => ['Developer', 'Super Admin', 'Admin'],
            'delete.product' => ['Developer', 'Super Admin', 'Admin'],
            'publish.product' => ['Developer', 'Super Admin'],



            ## Category

            'read.product-category' => ['Developer', 'Super Admin', 'Admin'],
            'create.product-category' => ['Developer', 'Super Admin', 'Admin'],
            'update.product-category' => ['Developer', 'Super Admin', 'Admin'],
            'delete.product-category' => ['Developer', 'Super Admin', 'Admin'],
            'publish.product-category' => ['Developer', 'Super Admin'],


            #Partner 

            ## Listing

            'read.partner' => ['Developer', 'Super Admin', 'Admin'],
            'create.partner' => ['Developer', 'Super Admin', 'Admin'],
            'update.partner' => ['Developer', 'Super Admin', 'Admin'],
            'delete.partner' => ['Developer', 'Super Admin', 'Admin'],
            'publish.partner' => ['Developer', 'Super Admin'],


            # Retribution


            ## Listing

            'read.retribution' => ['Developer', 'Super Admin', 'Admin'],
            'create.retribution' => ['Developer', 'Super Admin', 'Admin'],
            'update.retribution' => ['Developer', 'Super Admin', 'Admin'],
            'delete.retribution' => ['Developer', 'Super Admin', 'Admin'],
            'publish.retribution' => ['Developer', 'Super Admin'],

            ## Category

            'read.retribution-category' => ['Developer', 'Super Admin', 'Admin'],
            'create.retribution-category' => ['Developer', 'Super Admin', 'Admin'],
            'update.retribution-category' => ['Developer', 'Super Admin', 'Admin'],
            'delete.retribution-category' => ['Developer', 'Super Admin', 'Admin'],
            'publish.retribution-category' => ['Developer', 'Super Admin'],


            # FAQ

            ## Listing

            'read.faq' => ['Developer', 'Super Admin', 'Admin'],
            'create.faq' => ['Developer', 'Super Admin', 'Admin'],
            'update.faq' => ['Developer', 'Super Admin', 'Admin'],
            'delete.faq' => ['Developer', 'Super Admin', 'Admin'],
            'publish.faq' => ['Developer', 'Super Admin'],

            ## Category

            'read.faq-category' => ['Developer', 'Super Admin', 'Admin'],
            'create.faq-category' => ['Developer', 'Super Admin', 'Admin'],
            'update.faq-category' => ['Developer', 'Super Admin', 'Admin'],
            'delete.faq-category' => ['Developer', 'Super Admin', 'Admin'],
            'publish.faq-category' => ['Developer', 'Super Admin'],

            # Page

            'read.page' => ['Developer', 'Super Admin', 'Admin'],
            'create.page' => ['Developer'],
            'update.page' => ['Developer', 'Super Admin', 'Admin'],
            'delete.page' => ['Developer'],
            'publish.page' => ['Developer', 'Super Admin'],




            # Setting

            ## Main

            'read.setting-main' => ['Developer', 'Super Admin', 'Admin'],
            'create.setting-main' => ['Developer'],
            'update.setting-main' => ['Developer', 'Super Admin'],
            'delete.setting-main' => ['Developer'],

            ## Content

            'read.setting-content' => ['Developer', 'Super Admin', 'Admin'],
            'create.setting-content' => ['Developer'],
            'update.setting-content' => ['Developer', 'Super Admin'],
            'delete.setting-content' => ['Developer'],

            ## SEO

            'read.setting-seo' => ['Developer', 'Super Admin', 'Admin'],
            'create.setting-seo' => ['Developer'],
            'update.setting-seo' => ['Developer', 'Super Admin'],
            'delete.setting-seo' => ['Developer'],

            ## Navigation

            'read.setting-navigation' => ['Developer'],
            'create.setting-navigation' => ['Developer'],
            'update.setting-navigation' => ['Developer'],
            'delete.setting-navigation' => ['Developer'],

            # User

            'read.user' => ['Developer', 'Super Admin', 'Admin'],
            'create.user' => ['Developer', 'Super Admin'],
            'update.user' => ['Developer', 'Super Admin'],
            'delete.user' => ['Developer', 'Super Admin'],
            'export.user' => ['Developer', 'Super Admin'],
            'extra.user' => ['Developer', 'Super Admin'],

            # Role

            'read.role' => ['Developer', 'Super Admin'],
            'create.role' => ['Developer'],
            'update.role' => ['Developer'],
            'delete.role' => ['Developer'],
            'extra.role' => ['Developer'],

            # Permission

            'read.permission' => ['Developer', 'Super Admin'],
            'create.permission' => ['Developer'],
            'update.permission' => ['Developer'],
            'delete.permission' => ['Developer'],

            # Log

            'read.log' => ['Developer', 'Super Admin'],
            'create.log' => ['Developer'],
            'delete.log' => ['Developer'],
            'extra.log' => ['Developer'],
        ];
    }
}
