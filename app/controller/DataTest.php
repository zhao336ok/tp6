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

    public function time(){
//        $data = Db::name('table1')->where('create_time', '>', '2020-2-3')->select();
//        $data = Db::name('table1')->whereBetween('create_time',['2020-2-3','2020-4-9'])->select();
//        $data = Db::name('table1')->whereTime('create_time', '>', '2020-2-3')->select();
//        $data = Db::name('table1')->whereBetweenTime('create_time','2020-2-3', '2020-4-9')->select();
//        $data = Db::name('table1')->whereTime('create_time', '2020-2-3')->select();
//        $data = Db::name('table1')->whereYear('create_time')->select();//查询今年数据
//        $data1 = Db::name('table1')->whereYear('create_time', 'last year')->select();//查询去年数据
//        $data2 = Db::name('table1')->whereYear('create_time', '2019')->select();//查询某一年数据

//        $data = Db::name('table1')->whereMonth('create_time')->select();//查询当月数据
//        $data1 = Db::name('table1')->whereMonth('create_time', 'last month')->select();//查询上月数据
//        $data2 = Db::name('table1')->whereMonth('create_time', '2019-3')->select();//查询某月数据

//        $data = Db::name('table1')->whereDay('create_time')->select();//查询今天数据
//        $data1 = Db::name('table1')->whereDay('create_time', 'last day')->select();//查询昨天数据
//        $data2 = Db::name('table1')->whereDay('create_time', '2020-4-8')->select();//查询某天数据


//        $data = Db::name('table1')->whereTime('create_time', '-2 hours')->select();//查询两个小时之内数据
        Db::name('table1')->whereBetweenTimeField('create_time','update_time')->select();


        return Db::getLastSql();
        return json($data);
    }

    public function juhe(){
//        $data = Db::name('table1')->count();
//        $data = Db::name('table1')->count('age');
//        $data = Db::name('table1')->max('name', false);
//        $data = Db::name('table1')->min('age');
//        $data = Db::name('table1')->avg('age');
        $data = Db::name('table1')->sum('age');
        return json($data);
    }

    public function zichaxun(){
//        $data = Db::name('table1')->fetchSql(false)->select();
//        $data = Db::name('table1')->buildSql();
//        $query = Db::name('table2')->field('uid')->where('hobby', '乒乓球')->buildSql();
//        $data = Db::name('table1')->where('id', 'exp', 'IN '.$query)->select();

        $data = Db::name('table1')->where('id', 'in', function ($query){
            $query->name('table2')->field('uid')->where('hobby', '乒乓球');
        })->select();
        return json($data);
    }

    public function yuansheng(){
//        $data = Db::query('select * from table1');

        $data = Db::execute('update table1 set name="五五" where id=5');
        return json($data);
    }

    public function where(){
//        $data = Db::name('table1')->where('age', '>','55')->select();
//        $data = Db::name('table1')->where([
//            'name'=>'一一',
//            'age'=>11
//        ])->select();

//        $data = Db::name('table1')->where([
//            ['name', '=', '一一'],
//            ['age', '>', '10']
//        ])->select();

//        $map[] = ['sex', '=', '女'];
//        $map[] = ['age', 'in', [11, 44, 77]];
//        $data = Db::name('table1')->where($map)->select();

//        $data = Db::name('table1')->whereRaw('sex="女" AND age IN (11, 44, 77)')->select();

        $data = Db::name('table1')->whereRaw('id=:id', ['id'=>1])->select();
        return json($data);
    }

    public function field(){
        $db = Db::name('table1');

//        $data = $db->field('id, name')->select();
//        $data = $db->field('id, name as "姓名"')->select();
//        $data = $db->field(['id', 'name' => 'truename'])->select();

//        $data = $db->fieldRaw('name, SUM(age)')->select();
        $data = $db->withoutField('create_time, update_time')->select();
        return json($data);
    }

    public function alias(){
        $data = Db::name('table1')->alias('a')->select();

        return Db::getLastSql();
        return json($data);
    }
}