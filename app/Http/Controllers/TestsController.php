<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    public function __construct()
    {

    }

    public function all(Request $request)
    {
        $query = [
            [
                '$group' => [
                    '_id' => '$jour',
                    'tests' => [
                        '$sum' => '$t'
                    ],
                    'pos' => [
                        '$sum' => '$p'
                    ]
                ]

            ],
            [
                '$sort' => [
                    '_id' => 1
                ]
            ],
            [
                '$project' => [
                    'jour' => [
                        '$dateToString' => [
                            'format' => '%d-%m-%Y',
                            'date' => '$_id'
                        ]
                    ],
                    'tests' => '$tests',
                    'pos' => '$pos',
                    '_id' => 0
                ]
            ],
            [
                '$group' => [
                    '_id' => null,
                    'labels' => [
                        '$push' => '$jour'
                    ],
                    'tests' => [
                        '$push' => '$tests'
                    ],
                    'pos' => [
                        '$push' => '$pos'
                    ]
                ]
            ]
        ];


        /*         $query = '[
                    {
                      $match: {
                        "dep": "06"
                      }
                    },
                    {
                      $group: {
                        _id: "$jour",
                        tests: {
                          $sum: "$t"
                        },
                        pos: {
                          $sum: "$p"
                        }
                      }
                    },
                    {
                      $sort: {
                        _id: 1
                      }
                    },
                    {
                      $project: {
                        jour: {
                          $dateToString: {
                            format: "%d-%m-%Y",
                            date: "$_id"
                          }
                        },
                        tests: "$tests",
                        pos: "$pos",
                        _id: 0
                      }
                    },
                    {
                      "$group": {
                        "_id": null,
                        "jour": {
                          "$push": "$jour"
                        },
                        "tests": {
                          "$push": "$tests"
                        },
                        "pos": {
                          "$push": "$pos"
                        }
                      }
                    }
                  ]'; */


        $result = Test::raw(function ($collection) use ($query) {
            return $collection->aggregate($query);

        });

        $model = $result->first();

        $labels = json_decode(json_encode($model['labels']), true);
        $tests = json_decode(json_encode($model['tests']), true);
        $pos = json_decode(json_encode($model['pos']), true);


        /*
         *
         * db.collection.aggregate([{
    $group: {
      _id: "$jour",
      tests: {
        $sum: "$t"
      },
      positive: {
        $sum: "$p"
      },

    }
  },
  {
    $project: {
      jour: {
        $dateToString: {
          format: "%d-%m-%Y",
          date: "$_id"
        }
      },
      tests: "$tests",
      positive: "$positive",
      _id: 0
    }
  }
])
         */

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Tests',
                    'data' => $tests
                ],
                [
                    'label' => 'Positifs',
                    'backgroundColor' => '#FF0000',
                    'data' => $pos
                ],
            ]
        ];
    }

    public function dep(Request $request, $dep)
    {
        $query = [
            [
                '$match' => [
                    'dep' => $dep
                ]
            ],
            [
                '$group' => [
                    '_id' => '$jour',
                    'tests' => [
                        '$sum' => '$t'
                    ],
                    'pos' => [
                        '$sum' => '$p'
                    ]
                ]

            ],
            [
                '$sort' => [
                    '_id' => 1
                ]
            ],
            [
                '$project' => [
                    'jour' => [
                        '$dateToString' => [
                            'format' => '%d-%m-%Y',
                            'date' => '$_id'
                        ]
                    ],
                    'tests' => '$tests',
                    'pos' => '$pos',
                    '_id' => 0
                ]
            ],
            [
                '$group' => [
                    '_id' => null,
                    'labels' => [
                        '$push' => '$jour'
                    ],
                    'tests' => [
                        '$push' => '$tests'
                    ],
                    'pos' => [
                        '$push' => '$pos'
                    ]
                ]
            ]
        ];

        $result = Test::raw(function ($collection) use ($query) {
            return $collection->aggregate($query);

        });

        $model = $result->first();

        $labels = json_decode(json_encode($model['labels']), true);
        $tests = json_decode(json_encode($model['tests']), true);
        $pos = json_decode(json_encode($model['pos']), true);

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Tests',
                    'data' => $tests
                ],
                [
                    'label' => 'Positifs',
                    'backgroundColor' => '#FF0000',
                    'data' => $pos
                ],
            ]
        ];
    }

}
