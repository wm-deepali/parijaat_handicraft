<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->data() as $i => $cat) {
            $category = FaqCategory::updateOrCreate(
                ['name' => $cat['name']],
                ['icon' => $cat['icon'], 'sort_order' => $i + 1, 'status' => 1]
            );

            foreach ($cat['faqs'] as $j => [$question, $answer]) {
                Faq::updateOrCreate(
                    ['faq_category_id' => $category->id, 'question' => $question],
                    ['answer' => $answer, 'sort_order' => $j + 1, 'show_home' => 0, 'status' => 1]
                );
            }
        }
    }

    private function data(): array
    {
        return [
            [
                'name' => 'Shopping & Collections',
                'icon' => 'fa-solid fa-bag-shopping',
                'faqs' => [
                    ['What can I shop at Parijaat Handicraft?', 'We offer handcrafted brass and copper pieces including idols and statues, pooja essentials, copper drinkware, diyas and lamps, antique locks and keys, and bells and wind chimes. Browse everything in our <a href="/products">collections</a>.'],
                    ['Are your products handmade?', 'Our pieces are handcrafted, so small variations in detailing, finish and shade are part of their character. No two pieces are ever exactly alike.'],
                    ['Where can I find pieces for pooja and festivals?', 'Explore our Pooja Essentials and Brass Diyas & Lamps categories for traditional pieces made for devotion and celebration. Festive offers are shown on our home page during the season.'],
                    ['Do you have gift options?', 'Yes. Our gift collection includes housewarming gifts, traditional gifts and collectible treasures, each made to leave a lasting impression on any occasion.'],
                    ['Do you offer discounts and coupon codes?', 'Current offers and coupon codes are displayed on our website. Terms and conditions apply, and offers are valid for a limited time.'],
                ],
            ],
            [
                'name' => 'Product & Care',
                'icon' => 'fa-solid fa-gem',
                'faqs' => [
                    ['How can I check the details of a product before ordering?', 'Open the product page to view the images, material and finish details, product description, pricing and offers before placing your order.'],
                    ['What is the difference between lacquered and raw brass?', 'Lacquered brass has a protective coating for a lasting shine, while raw brass is left unlacquered so it can age naturally. The finish is listed on each product page.'],
                    ['How do I clean and polish brass at home?', 'Wipe dust with a soft dry cloth, and use mild soap and warm water on lacquered pieces. Raw brass can be polished gently when it loses its shine. Read our full <a href="/blog/how-to-clean-and-polish-brass-at-home-without-damaging-it">brass care guide</a> for step-by-step tips.'],
                    ['Will the colour look exactly the same as shown online?', 'We try to show colours as accurately as possible. Slight variations may occur due to photography, lighting and individual screen settings.'],
                    ['Can I ask about availability before ordering?', 'Yes. To confirm availability or product details, reach our team through the <a href="/contact">Contact page</a> by call or WhatsApp.'],
                ],
            ],
            [
                'name' => 'Orders & Payments',
                'icon' => 'fa-solid fa-credit-card',
                'faqs' => [
                    ['How can I place an order?', 'Choose a product, click Add to Cart or Buy Now, and complete the checkout steps to confirm your purchase.'],
                    ['What payment methods are available?', 'Available payment methods are displayed at checkout. Please review the options shown for your order before paying.'],
                    ['How do I use a coupon code?', 'Enter a valid coupon code at checkout. Each code has its own terms and validity, which are mentioned alongside the offer.'],
                    ['Can I cancel my order after placing it?', 'Cancellation depends on the order status and our store policy. Contact our support team as soon as possible with your order details.'],
                    ['How can I get help with my order?', 'Contact our team with your order number and query. We can help with order questions, product information and delivery updates.'],
                ],
            ],
            [
                'name' => 'Shipping & Delivery',
                'icon' => 'fa-solid fa-truck-fast',
                'faqs' => [
                    ['How long will my order take to arrive?', 'Delivery time depends on your location, product availability and the shipping method used. The applicable delivery information is shown during checkout.'],
                    ['Do you offer free shipping?', 'Free shipping offers and their eligibility are shown on our website and at checkout. Terms and conditions apply.'],
                    ['Can I track my order?', 'If tracking is available for your shipment, the details are shared once your order has been dispatched.'],
                    ['Do you deliver outside India?', 'We serve customers in India and abroad. Availability for your location is shown at checkout, and customers in the United States can also shop through our Amazon store.'],
                    ['What should I do if my order is delayed?', 'If your order has not arrived within the expected period, contact our support team with your order number and we will check the latest shipment information for you.'],
                ],
            ],
            [
                'name' => 'Returns & Exchanges',
                'icon' => 'fa-solid fa-rotate-left',
                'faqs' => [
                    ['Can I return or exchange a product?', 'Returns and exchanges are subject to the applicable product and store policy. Please review the Returns & Exchanges policy for eligibility, timelines and exclusions before raising a request.'],
                    ['What if I receive a damaged or incorrect product?', 'Contact our support team as soon as possible with your order details and clear photographs of the product and packaging. We will guide you through the next steps.'],
                    ['Is a small variation in a handcrafted piece a defect?', 'Minor variations in detailing and finish are natural in handcrafted work. If you are unsure whether something is a variation or a defect, send us photos and our team will help.'],
                ],
            ],
            [
                'name' => 'Bulk & Support',
                'icon' => 'fa-solid fa-headset',
                'faqs' => [
                    ['Do you accept bulk and wholesale orders?', 'Yes. Share your requirements through the <a href="javascript:void(0);" data-model=".enquiry-pop">bulk enquiry form</a> and our team will reply with pricing and availability.'],
                    ['Can I contact you on WhatsApp before buying?', 'Yes. WhatsApp is a convenient way to ask about availability, finishes, gifting options and general shopping queries before you order.'],
                    ['How can I contact Parijaat Handicraft?', 'You can reach our team by phone, WhatsApp or email. Visit the <a href="/contact">Contact page</a> for all the available contact details.'],
                    ['Can I partner with Parijaat Handicraft?', 'If you love handcrafted products and want to introduce them to a wider audience, use the Apply for Partnership option on our home page and our team will get in touch.'],
                ],
            ],
        ];
    }
}