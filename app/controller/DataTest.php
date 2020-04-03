<?php
namespace app\controller;

use app\model\Table1;
use think\facade\Db;

class DataTest
{
    public function index(){
        $data = Db::connect('mysql')->table('table1')->select();
        return json($data);
    }

    public function demo(){
        $data = Db::connect('demo')->table('table1')->select();
        return json($data);
    }

    public function Table1(){
        $data = Table1::select();
        return json($data);
    }

    public function getone(){
        //$data1 = Db::table('table1')->where('id', 30)->find();
        //$data2 = Db::table('table1')->where('id', 30)->findOrFail();
        $data3 = Db::table('table1')->where('id', 30)->findOrEmpty();
        return json($data3);
        //return Db::getLastSql();
    }

    public function getall(){
        //$data = Db::table('table1')->select();
        //$data1 = Db::table('talbe1')->where('id', 30)->selectOrFail();
        //return json($data);
        $data3 = Db::table('table1')->select()->toArray();
        dump($data3);
        //return Db::getLastSql();
    }

    public function getelse(){
        //$data = Db::table('table1')->where('id', 3)->value('name');
        //echo $data;

        $data1 = Db::table('table1')->column('name', 'id');
        return json($data1);
    }

    public function getmoredata(){
//        Db::table('table1')->chunk(3, function ($datas){
//           foreach ($datas as $data){
//               dump($data);
//           }
//           echo '------------------------------------------------';
//        });

        $cursor = Db::table('table1')->cursor();
        foreach ($cursor as $item) {
            dump($item);
        }
    }

    public function getQiTa(){
        $table1 = Db::table('table1');
        $data1 = $table1->where('id', 3)->find();
        // $data2 = $table1->select();
        $table1->removeOption('where')->select();
        return Db::getLastSql();
    }

    public function insert(){
//        $data = [
//            'name'=>'哈哈',
//            'school'=>'哈班',
//            'sex'=>'女'
//        ];
//        Db::table('table1')->insert($data);

       $data = [
            'name'=>'哈哈11',
            'school'=>'哈班11',
            'sex'=>'女1',
        ];
//        return Db::table('table1')->insertGetId($data);
        return Db::name('table1')->save($data);
    }

    public function insertAll(){
      $data = [
          [
              'name'=>'嘿嘿1',
              'school'=>'嘿班1'
          ],
          [
              'name'=>'嘿嘿2',
              'school'=>'嘿班2'
          ]
      ];
      return Db::name('table1')->insertAll($data);
    }

    public function update(){
//        $data = [
//            'name'=>'哈嘿1'
//        ];
//        return Db::name('table1')->where('id', 7)->update($data);

//        return Db::name('table1')->update([
//           'id'=>7,
//            'name'=>'哈哈11'
//        ]);
//        Db::name('table1')->where('id', 17)
//            ->exp('sex','UPPER(sex)')
//            ->update();
//        Db::name('table1')->where('id', 18)
//            ->inc('age')
//            ->dec('weight', 2)
//            ->update();
//        Db::name('table1')->where('id', 17)
//            ->update([
//                    'sex'=>     Db::raw('UPPER(sex)'),
//                    'age'=>     Db::raw('age+1'),
//                    'weight'=>  Db::raw('weight-2')
//                ]);
        Db::name('table1')->where('id', 17)->save(['name'=>'不知道']);
    }

    public function delete(){
//        Db::name('table1')->delete(19);
//        Db::name('table1')->delete([10, 11, 12]);
        Db::name('table2')->delete(true);
    }

    public function bijiao(){
//        $data = Db::name('table1')->where('age', '<', 15)->select();
//        $data = Db::name('table1')->where('name', 'like', '%哈哈%')->select();
//        $data = Db::name('table1')->where('name', 'like', ['%一%', '%二%'], 'or')->select();
//        $data = Db::name('table1')->whereLike('name', '%一%')->select();
//        $data = Db::name('table1')->where('age', 'between', '10,15')->select();
//        $data = Db::name('table1')->whereBetween('age', '10, 15')->select();
//        $data = Db::name('table1')->where('id', 'in', '3,4,5')->select();
//        $data = Db::name('table1')->whereIn('id', '1,2,3')->select();
//        $data = Db::name('table1')->where('sex', 'null')->select();
//        $data = Db::name('table1')->whereNull('age')->select();
//        $data = Db::name('table1')->where('id', 'exp', 'in (1,2,3)')->select();
        $data = Db::name('table1')->whereExp('id', ' not in (1,2,3,4,5,6)')->select();
        return json($data);
    }
}