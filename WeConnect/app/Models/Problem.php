<?php
/*
 * @Author: Nattapong Kamma Icezazarun@gmail.com
 * @Date: 2025-04-05 10:09:41
 * @LastEditors: Nattapong Kamma Icezazarun@gmail.com
 * @LastEditTime: 2025-04-05 10:10:13
 * @FilePath: \cluster2\WeConnect\app\Models\Problem.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

    protected $fillable = ['user_name', 'location', 'category', 'description'];
}

