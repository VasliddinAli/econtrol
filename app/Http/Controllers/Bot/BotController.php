<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Controller;
use App\Models\CEO;
use Illuminate\Support\Facades\Log;

class BotController extends Controller
{
    public function bot()
    {
        define('API_KEY', '6003340158:AAF3BmwSH3HrU9Kaz69vC9hXtp5zhH-lIbQ');

        function sendResponse($method, $datas = [])
        {
            $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);

            $res = curl_exec($ch);
            if (curl_error($ch)) {
                var_dump(curl_error($ch));
            } else {
                return json_decode($res);
            }
        }

        $update = file_get_contents('php://input');
        Log::info($update);
        $update = json_decode($update, false);

        $message = "";
        $text = "";
        if (isset($update->callback_query)) {
            $message = $update->callback_query->message;
            $chat_id = $message->chat->id;
        } elseif (isset($update->edited_message)) {
            $message = $update->edited_message;
            $chat_id = $message->chat->id;
        } elseif (isset($update->my_chat_member)) {
            $message = $update->my_chat_member;
            $chat_id = $message->chat->id;
        } elseif (isset($update->channel_post)) {
            $message = $update->channel_post;
            $chat_id = $message->sender_chat->id;
        } else {
            $message = $update->message;
            $chat_id = $message->chat->id;
        }

        if (isset($message->text)) {
            $text = $message->text;
            if (isset($message->entities)) {
                $entities = $message->entities;
            }
        }

        $manager = 5803268621;

        if (isset($message->contact)) {
            $phone = $message->contact->phone_number;
            $ceo = CEO::where('phone', $phone)->first();

            if ($phone == $ceo->phone) {
                $ceo->update(['bot_id' => $chat_id]);
            } else {
                sendResponse('sendMessage', [
                    'chat_id' => $chat_id,
                    'text' => $phone,
                ]);
                // return;
            }
        }

        // function checkAdminChatId($chat_id)
        // {
        //     return CEO::where('bot_id', $chat_id)->first();
        // }

        if ($text == '/start') {
            sendResponse('sendMessage', [
                'chat_id' => $chat_id,
                'text' => "Assalomu alaykum!\nE-Control tizimiga xush kelibsiz! ID: $chat_id\n\nTizimdan foydalanish uchun telefon raqamingizni yuborishingiz kerak bo'ladi",
                "reply_markup" => json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Telefon raqamni yuborish", 'request_contact' => true]],
                    ]
                ]),
            ]);
        } elseif ($text == '/reports') {
            sendResponse('sendMessage', [
                'chat_id' => $chat_id,
                'text' => "👨‍💻Admin: \n\nBarcha hisobotlar 👇👇👇",
                'reply_markup' => json_encode([
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [['text' => "Barcha hisobotlar", 'web_app' => [
                            "url" => "https://econtrol.devapp.uz/attendance/bot/view"
                        ]]],
                    ]
                ])
            ]);
        }

        // function getButton($order_or_user_id, $button_text, $status, $type)
        // {
        //     $button = [
        //         'text' => $button_text,
        //         'callback_data' => json_encode(array("id" => $order_or_user_id, "st" => $status, "tp" => $type))
        //     ];
        //     return $button;
        // }

        // function getOrders($chat_id, $status, $app_user_id, $type)
        // {
        //     if ($type == "order") {
        //         $orders = Order::where('status', $status)->get();
        //     } elseif ($type == "user_order") {
        //         $orders = Order::where('app_user_id', $app_user_id)->get();
        //     }
        //     if ($orders->count() > 0) {
        //         foreach ($orders as $index => $order) {

        //             $index++;
        //             if ($index % 10 == 0) {
        //                 sleep(1);
        //             }
        //             $order_data = "";
        //             $statuses = "";
        //             $keys = [];
        //             $paid_button = getButton($order->id, "🟢 To'lovni tasdiqlash", "pd", "or");
        //             $sended_button = getButton($order->id, "🔵 Jo'natildi", "sd", "or");
        //             $client_canceled_button = getButton($order->id, "🔴 Buyurtmachi bekor qildi", "ccl", "or");
        //             $operator_canceled_button = getButton($order->id, "🔴 Operator bekor qildi", "ocl", "or");
        //             if ($type == "user_order") {
        //                 $status = $order->status;
        //             }
        //             if ($status == 'paid_waiting') {
        //                 $statuses = "To'lov kutilmoqda...";
        //                 $keys = [
        //                     [
        //                         $paid_button,
        //                     ],
        //                     [
        //                         $client_canceled_button,
        //                     ],
        //                     [
        //                         $operator_canceled_button,
        //                     ],
        //                 ];
        //             } elseif ($status == 'paid') {
        //                 $statuses = "To'lov tasdiqlangan";
        //                 $keys = [
        //                     [
        //                         $sended_button,
        //                     ],
        //                     [
        //                         $client_canceled_button,
        //                     ],
        //                     [
        //                         $operator_canceled_button,
        //                     ]
        //                 ];
        //             } elseif ($status == 'sended') {
        //                 $statuses = "Tugatilgan";
        //             } elseif ($status == 'client_canceled') {
        //                 $statuses = "Buyurtmachi bekor qildi";
        //             } elseif ($status == 'operator_canceled') {
        //                 $statuses = "Operator bekor qildi";
        //             }

        //             $fullname = $order->user->fullname;
        //             $phone = $order->user->phone;
        //             $user_status = $order->user->status == 'deleted' ? "(⚠️ O'chirilgan)" : "";
        //             $comment = $order->comment;
        //             $address = $order->address;
        //             $address_type = "";
        //             $for_island = "Ha";
        //             $address_image = "";
        //             $payment_type = $order->payment_type == 'card' ? 'Bank kartasi orqali' : 'Bank orqali';
        //             $total_amount = $order->total_amount;
        //             $create_date = $order->created_at;
        //             $paid_date = $order->paid_date;
        //             if ($paid_date == null) {
        //                 $paid_date = "To'lanmagan!";
        //             }

        //             $order_info = "<b>Buyurtma ma’lumotlari:</b> ⬇️\n#️⃣ <b>ID:</b> #$order->id\n🔰 <b>Holat:</b> $statuses\n👤 <b>Buyurtmachi: $fullname $phone $user_status</b>\n📄 <b>Izoh:</b> $comment\n📆 <b>Buyurtma sanasi:</b> $create_date\n📅 <b>To'langan sana:</b> $paid_date";
        //             $pay_info = "\n——————————————\n<b>To'lov ma'lumotlari:</b> ⬇️\n💳 <b>To'lov turi:</b> $payment_type\n💰 <b>Mahsulotlar narxi:</b> $order->products_amount ₩\n🏷️ <b>Keshbekdan to'lov:</b> $order->pay_with_cashback_amount ₩\n✂️ <b>Chegirma:</b> $order->discount_amount ₩\n🚚 <b>Dostavka:</b> $order->delivery_amount ₩\n✅ <b>Umumiy summa:</b> $total_amount ₩";

        //             if ($address == null) {
        //                 $address_info = "\n——————————————\n<b>Manzil ma’lumotlari:</b> ⚠️Manzil mavjud emas!";
        //             } else {
        //                 $address_image = $order->address->address_image;

        //                 if ($address->type == 'door') {
        //                     $address_type = "Eshik oldida";
        //                 } elseif ($address->type == 'guardhouse') {
        //                     $address_type = "Qorovulxonada";
        //                 } else {
        //                     $address_type = $address->drop_location_text;
        //                 }
        //                 if ($address->for_island == 0) {
        //                     $for_island = "Yo'q";
        //                 }
        //                 $address_info = "\n——————————————\n<b>Manzil ma’lumotlari:</b> ⬇️\n👤 <b>Qabul qiluvchi: $address->receiver_name $address->receiver_phone</b>\n🏠 <b>Manzil:</b> $address->address\n🏢 <b>Bino va hona raqami:</b> $address->building_room_number\n📍 <b>Qoldirish joyi:</b> $address_type\n🔐 <b>Eshik kodi:</b> $address->door_code\n🌐 <b>Orol:</b> $for_island";
        //             }

        //             $order_data = $order_info . $pay_info . $address_info;
        //             $base_url = url('/');
        //             $url_photo = $base_url . "/" . $address_image;

        //             sendResponse('sendMessage', [
        //                 'chat_id' => $chat_id,
        //                 'text' => $order_data,
        //                 "reply_markup" => json_encode([
        //                     'inline_keyboard' => $keys
        //                 ]),
        //                 "parse_mode" => 'html'
        //             ]);

        //             if ($address_image != null) {
        //                 sendResponse('sendPhoto', [
        //                     'chat_id' => $chat_id,
        //                     'photo' => $url_photo,
        //                     'caption' => "<b>Manzil rasmi:</b> ⬆️\n#️⃣ <b>ID:</b> #$order->id",
        //                     "parse_mode" => 'html'
        //                 ]);
        //             }

        //             $order_product_data = "<b>Mahsulotlar:</b> ⬇️\n#️⃣ <b>ID:</b> #$order->id";
        //             $order_products = $order->order_products->sortBy('product.category_id');
        //             foreach ($order_products as $key => $order_product) {
        //                 $key++;
        //                 $product_name = $order_product->name_uz;
        //                 $count = $order_product->count;
        //                 $summa = $order_product->summa;
        //                 $total_summa = $order_product->summa * $count;
        //                 $unity = $order_product->unity->name_uz;
        //                 $currency = $order_product->currency;
        //                 $order_product_data .= "\n——————————————\n📜 <b>Nomi:</b> $product_name\n💰 <b>Narxi:</b> $summa $currency\n🔢 <b>Soni:</b> $count $unity\n🧾 <b>To'lov:</b> $total_summa $currency";

        //                 if ($key % 10 == 0) {
        //                     sendResponse('sendMessage', [
        //                         'chat_id' => $chat_id,
        //                         'text' => $order_product_data,
        //                         "parse_mode" => 'html'
        //                     ]);
        //                     $order_product_data = "";
        //                     $key = 0;
        //                 }
        //             }

        //             sendResponse('sendMessage', [
        //                 'chat_id' => $chat_id,
        //                 'text' => $order_product_data,
        //                 "parse_mode" => 'html'
        //             ]);

        //             sendResponse('sendMessage', [
        //                 'chat_id' => $chat_id,
        //                 'text' => "⭕️⭕️⭕️⭕️⭕️⭕️⭕️⭕️⭕️⭕️️",
        //             ]);
        //         }
        //     } else {
        //         if ($status == 'paid_waiting') {
        //             $statuses = "To'lov kutilmoqda...";
        //         } elseif ($status == 'paid') {
        //             $statuses = "To'lov tasdiqlangan";
        //         } elseif ($status == 'sended') {
        //             $statuses = "Tugatilgan";
        //         } elseif ($status == 'client_canceled') {
        //             $statuses = "Buyurtmachi bekor qildi";
        //         } elseif ($status == 'operator_canceled') {
        //             $statuses = "Operator bekor qildi";
        //         }
        //         $order_data = "🔰 $statuses\n⚠️ Bunday holatdagi buyurtmalar mavjud emas!";
        //         sendResponse('sendMessage', [
        //             'chat_id' => $chat_id,
        //             'text' => $order_data,
        //         ]);
        //     }
        // }

        // function getAppUsers($chat_id, $phone)
        // {
        //     $app_users = AppUser::where('phone', 'LIKE', "%{$phone}%")->get();
        //     if ($app_users->count() > 0) {
        //         foreach ($app_users as $app_user) {
        //             if ($app_user->status == 'waiting' || $app_user->status == 'accept') {
        //                 $statuses = "Tasdiqlangan foydalanuvchi";
        //             } elseif ($app_user->status == 'blocked') {
        //                 $statuses = "Bloklangan foydalanuvchi";
        //             } elseif ($app_user->status == 'deleted') {
        //                 $statuses = "O'chirilgan foydalanuvchi";
        //             }
        //             $fullname = $app_user->fullname;
        //             $phone = $app_user->phone;
        //             $cashback = $app_user->cashback == null ? 0 : $app_user->cashback;
        //             $app_user_data = "🔰 $statuses\n👤 $fullname\n📱 $phone\n💰 $cashback";
        //             $order_button = getButton($app_user->id, "Buyurtmalarni ko'rish", "", "uor");
        //             $keys = [
        //                 [
        //                     $order_button
        //                 ]
        //             ];

        //             sendResponse('sendMessage', [
        //                 'chat_id' => $chat_id,
        //                 'text' => $app_user_data,
        //                 "reply_markup" => json_encode([
        //                     'inline_keyboard' => $keys
        //                 ])
        //             ]);
        //         }
        //     } else {
        //         $user_data = "📱 $phone\n⚠️ Bunday telefon raqamda foydalanuvchilar mavjud emas!";
        //         sendResponse('sendMessage', [
        //             'chat_id' => $chat_id,
        //             'text' => $user_data,
        //         ]);
        //     }

        // }

        // if ($text == "/start") {
        //     startBot($chat_id);
        //     $admin = checkAdminChatId($chat_id);
        //     if ($admin != null) {
        //         $commands = "\n\n/start Yangilash\n/pay_waiting_orders 🟡 To'lov kutilayotgan buyurtmalar \n/pay_confirmed_orders 🟢 To'lov tasdiqlangan buyurtmalar\n/completed_orders 🔵 Tugatilgan buyurtmalar\n/client_canceled_orders 🔴 Mijoz bekor qilgan buyurtmalar\n/operator_canceled_orders 🔴 Operator bekor qilgan buyurtmalar\n/stop_orders 🛑 Buyurtmalar olishni to'htatish\n/start_orders 🚀 Buyurtmalar olishni boshlash\n/find_client_by_phone 🔎 Telefon raqam bo'yicha mijozni qidirish";
        //         sendResponse('sendMessage', [
        //             'chat_id' => $chat_id,
        //             'text' => "👨‍💻Admin: " . $admin->name . $commands,
        //         ]);
        //     }
        // } elseif ($text == "/pay_waiting_orders") {

        //     $admin = checkAdminChatId($chat_id);
        //     if ($admin != null) {
        //         getOrders($chat_id, "paid_waiting", 0, "order");
        //     } else {
        //         startBot($chat_id);
        //     }
        // } elseif ($text == "/pay_confirmed_orders") {

        //     $admin = checkAdminChatId($chat_id);
        //     if ($admin != null) {
        //         getOrders($chat_id, "paid", 0, "order");
        //     } else {
        //         startBot($chat_id);
        //     }
        // } elseif ($text == "/completed_orders") {

        //     $admin = checkAdminChatId($chat_id);
        //     if ($admin != null) {
        //         getOrders($chat_id, "sended", 0, "order");
        //     } else {
        //         startBot($chat_id);
        //     }
        // } elseif ($text == "/client_canceled_orders") {

        //     $admin = checkAdminChatId($chat_id);
        //     if ($admin != null) {
        //         getOrders($chat_id, "client_canceled", 0, "order");
        //     } else {
        //         startBot($chat_id);
        //     }
        // } elseif ($text == "/operator_canceled_orders") {

        //     $admin = checkAdminChatId($chat_id);
        //     if ($admin != null) {
        //         getOrders($chat_id, "operator_canceled", 0, "order");
        //     } else {
        //         startBot($chat_id);
        //     }
        // } elseif (isset($update->callback_query)) {
        //     $callback_update = $update->callback_query;
        //     $data = json_decode($callback_update->data);
        //     $order_or_user_id = $data->id;
        //     $status = $data->st;
        //     $type = $data->tp;
        //     $chat_id = $callback_update->from->id;
        //     $check_message = $callback_update->message;
        //     $is_channel = false;
        //     if (isset($check_message->sender_chat) && $check_message->sender_chat->type == 'channel') {
        //         $chat_id = $check_message->chat->id;
        //         $is_channel = true;
        //     }
        //     $message_id = $callback_update->message->message_id;

        //     $admin = checkAdminChatId($chat_id);
        //     if ($admin != null) {
        //         if ($status == 'pd') {
        //             $status = 'paid';
        //         } elseif ($status == 'sd') {
        //             $status = 'sended';
        //         } elseif ($status == 'ccl') {
        //             $status = 'client_canceled';
        //         } elseif ($status == 'ocl') {
        //             $status = 'operator_canceled';
        //         }
        //         if ($type == 'or') {
        //             $order = Order::where('id', $order_or_user_id)->first();
        //             $app_user = AppUser::where('id', $order->app_user_id)->first();
        //             $app_user_cashback = $app_user->cashback;

        //             if ($status == 'paid' && $order->products_cashback > 0) {
        //                 $app_user->update([
        //                     'cashback' => $app_user_cashback + $order->products_cashback
        //                 ]);

        //                 $order->update([
        //                     'paid_date' => Carbon::now()
        //                 ]);

        //             } elseif ($status == 'client_canceled' || $status == 'operator_canceled') {
        //                 if ($order->status == 'paid') {
        //                     $app_user->update([
        //                         'cashback' => $app_user_cashback - $order->products_cashback
        //                     ]);
        //                 }
        //             }

        //             $lang = $app_user->lang == null ? 'uz' : $app_user->lang;
        //             $statuses = "";
        //             $statuses_channel = "";
        //             if ($status == 'paid') {
        //                 $lang_statuses = self::PAY_CONFIRM_ORDER_MESSAGE[$lang];
        //                 $statuses = "🟢 To'lov tasdiqlandi!";
        //                 $statuses_channel = "✅✅✅  TO'LOV TASDIQLANDI  ✅✅✅";
        //             } elseif ($status == 'sended') {
        //                 $lang_statuses = self::SENDED_ORDER_MESSAGE[$lang];
        //                 $statuses = "🔵 Jo'natildi!";
        //                 $statuses_channel = "✅✅✅  JO'NATILDI  ✅✅✅";
        //             } elseif ($status == 'client_canceled') {
        //                 $lang_statuses = self::CLIENT_CANCEL_ORDER_MESSAGE[$lang];
        //                 $statuses = "🔴 Buyurtmachi bekor qildi!";
        //                 $statuses_channel = "⛔️⛔️⛔️ BEKOR QILINDI  ⛔️⛔️⛔️";
        //             } elseif ($status == 'operator_canceled') {
        //                 $lang_statuses = self::OPERATOR_CANCEL_ORDER_MESSAGE[$lang];
        //                 $statuses = "🔴 Operator bekor qildi!";
        //                 $statuses_channel = "⛔️⛔️⛔️ BEKOR QILINDI  ⛔️⛔️⛔️";
        //             }

        //             if ($status == $order->status && $order->panel_user_id > 0) {
        //                 $panel_user = $order->panel_user;
        //                 $statuses = "⚠️ #ID: $order->panel_user_id $panel_user->name tomonidan avval o'zgartirilgan: " . $statuses;
        //             } else {
        //                 $order->update([
        //                     'panel_user_id' => $admin->id,
        //                     'status' => $status,
        //                 ]);
        //                 if ($status == 'paid') {
        //                     $this->sendOrdersData($order->id, 'channel');
        //                 }
        //                 $your_order = self::YOUR_ORDER_MESSAGE[$lang];
        //                 $this->sendFCM($your_order, $lang_statuses, 'order', 'user', $app_user->fcm_token);
        //             }

        //             if (!$is_channel) {
        //                 sendResponse('editMessageText', [
        //                     'chat_id' => $chat_id,
        //                     'text' => $text . "\n\n$statuses",
        //                     'message_id' => $message_id,
        //                     'entities' => json_encode($entities),
        //                 ]);

        //                 sendResponse('sendMessage', [
        //                     'chat_id' => $chat_id,
        //                     'text' => "🔰 Ushbu buyurtma - $statuses",
        //                     'reply_to_message_id' => $message_id
        //                 ]);
        //             } else {
        //                 sendResponse('editMessageText', [
        //                     'chat_id' => $chat_id,
        //                     'text' => $text . "\n\n$statuses_channel",
        //                     'message_id' => $message_id,
        //                     'entities' => json_encode($entities),
        //                 ]);
        //             }

        //         } elseif ($type == 'uor') {

        //             sendResponse('editMessageText', [
        //                 'chat_id' => $chat_id,
        //                 'text' => $text . "\n\n📦 Buyurtmalar: ⬇️",
        //                 'message_id' => $message_id,
        //                 "parse_mode" => 'html'
        //             ]);
        //             getOrders($chat_id, "", $order_or_user_id, "user_order");
        //         }
        //     } else {
        //         startBot($chat_id);
        //     }
        // } elseif ($text == "/stop_orders") {
        //     $admin = checkAdminChatId($chat_id);
        //     if ($admin != null) {
        //         $setting = AppSetting::first();
        //         $setting->update([
        //             'allow_order' => 0
        //         ]);
        //         sendResponse('sendMessage', [
        //             'chat_id' => $chat_id,
        //             'text' => "🛑 Buyurtmalar olish to'htatildi!",
        //         ]);
        //     } else {
        //         startBot($chat_id);
        //     }
        // } elseif ($text == "/start_orders") {
        //     $admin = checkAdminChatId($chat_id);
        //     if ($admin != null) {
        //         $setting = AppSetting::first();
        //         $setting->update([
        //             'allow_order' => 1
        //         ]);
        //         sendResponse('sendMessage', [
        //             'chat_id' => $chat_id,
        //             'text' => "🚀 Buyurtmalar olish boshlandi!",
        //         ]);
        //     } else {
        //         startBot($chat_id);
        //     }
        // } elseif ($text == "/find_client_by_phone") {
        //     $admin = checkAdminChatId($chat_id);
        //     if ($admin != null) {
        //         $admin->update([
        //             'bot_last_command' => "find_client_by_phone"
        //         ]);
        //         sendResponse('sendMessage', [
        //             'chat_id' => $chat_id,
        //             'text' => "📱 Telefon raqamni kiriting va jo'nating!",
        //         ]);
        //     } else {
        //         startBot($chat_id);
        //     }
        // } elseif ($text) {
        //     $admin = checkAdminChatId($chat_id);
        //     if ($admin != null && $admin->bot_last_command == 'find_client_by_phone') {
        //         getAppUsers($chat_id, $text);
        //     } else {
        //         startBot($chat_id);
        //     }
        // }
    }
}
