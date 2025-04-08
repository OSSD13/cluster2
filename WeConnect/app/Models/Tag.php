<?php
/*
 * @Author: Nattapong Kamma Icezazarun@gmail.com
 * @Date: 2025-04-08 14:24:16
 * @LastEditors: Nattapong Kamma Icezazarun@gmail.com
 * @LastEditTime: 2025-04-08 14:24:53
 * @FilePath: \cluster2\WeConnect\app\Models\Tag.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function edit($id)
{
    $problem = Problem::findOrFail($id);
    $tags = Tag::all(); // ดึง tag ทั้งหมด
    return view('your_view_name', compact('problem', 'tags'));
}

}
