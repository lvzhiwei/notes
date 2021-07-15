<?php

/**
 * 常用算法类
 * Class Algo
 */
class Algo
{
	/**
	 * 二分法查找, 在有序集合中, 查找指定值的index
	 * 二分法查找也可以使用递归
	 *
	 * @param $shortedArr
	 * @param $value
	 */
	public function binarySearch($shortedArr, $target)
	{
		$low = 0;
		$high = count($shortedArr) -1;
		$times = 0;
		while ($low <= $high) {
			$times += 1;
			$mid = floor(($low + $high)/2);
			if ($target > $shortedArr[$mid])
			{
				$low = $mid + 1;
			} elseif ($target < $shortedArr[$mid])
			{
				$high = $mid-1;
			} else {
				echo '当前是第' . $times . '次遍历' . PHP_EOL;
				return $mid;
			}
			echo '当前是第' . $times . '次遍历' . PHP_EOL;
		}

		return -1;
	}

	/**
	 * 选择排序,  选出最小的值, 与第一个index 进行交换
	 * 循环处理第二个, 第三个位置
	 *
	 * @param $arr
	 * @return array
	 */
	public function selectShort($arr)
	{
		$len = count($arr);
		$times = 0;
		for ($i=0; $i <= $len-1; $i++)
		{
			$minIndex = $i;
			for ($j=$i+1; $j <= $len-1; $j++)
			{
				if ($arr[$minIndex] > $arr[$j])
				{
					$minIndex = $j;
				}
				$times += 1;
//				echo '当前是第' . $times . '次遍历' . PHP_EOL;
			}
			if ($i != $minIndex)
			{
				// 交换位置
				$temp = $arr[$i];
				$arr[$i] = $arr[$minIndex];
				$arr[$minIndex] = $temp;
			}
		}

		return $arr;
	}


	/**
	 * 快速排序, 分而治之的思想, 使用递归实现
	 * 把一个值作为基准, 小于基准值的则作为左侧, 大于基准值的则放在右侧, 对两个数组分别做快速排序, 并合并左右两个数组和中间的基准值.
	 * @param array $arr
	 * @return array $arr
	 */
	public function quickSort($arr)
	{
		$len = count($arr);
		if ($len < 2)
			return $arr;
		$less = [];
		$great = [];
		$pivot = $arr[0];
		for ($i=1; $i < $len; $i++)
		{
			if ($arr[$i] <= $pivot)
				$less[] = $arr[$i];
			else
				$great[] = $arr[$i];
		}

		return array_merge($this->quickSort($less), [$pivot], $this->quickSort($great));
	}


	/**
	 * 广度优先搜索
	 *
	 * @param array $arr
	 * [
	 *  'a' => [
	 *  'b','c','d'
	 * ],
	 * 'b'=>['c'],
	 * 'd'=>['a'],
	 * 'c'=>['e']
	 * ]
	 * 如何从 a 找到 e 的最短路径? 需要多少步?
	 * @param string $from
	 * @param string $target
	 * @return array
	 * @author lvzhiwei <im.lvzhiwei@gmail.com>
	 *
	 * 2021/7/13 17:43
	 */
	public function breadthFirstSearch(array $arr, string $from, string $target)
	{
		$traverse_data = [$from]; //路径
		$queue = $arr[$from] ?? []; //队列
		$processed = [$from]; //已处理的节点
		while (!empty($queue)) {
			$node = array_shift($queue); //当前处理的节点

			if (in_array($node, $processed))
				continue;

//			$waitHandle[] = $node;
			$processed[] = $node;
			$traverse_data[] = $node; //进入顺序
			if ($node == $target)
			{
				return $traverse_data;
			} else {
//				var_dump(1111, $node);
				$subNodes = array_key_exists($node, $arr) ? $arr[$node] : [];

				if (!empty($subNodes))
					array_push($queue, ...$subNodes); //压入节点
				else
					array_pop($traverse_data); //没有子节点, 则弹出最后一个值
				var_dump($node, $subNodes, $traverse_data);
			}

		}

		return $traverse_data;
	}

	/**
	 * 深度优先搜索
	 *
	 * @param array $arr
	 * @param string $from
	 * @param string $target
	 * @author lvzhiwei <im.lvzhiwei@gmail.com>
	 *
	 * 2021/7/14 17:25
	 */
	public function depthFirstSearch(array $arr, string $from, string $target)
	{

	}

	/**
	 * 狄克斯特拉算法(Dijkstra)
	 *
	 * @author lvzhiwei <im.lvzhiwei@gmail.com>
	 *
	 * 2021/7/14 17:36
	 */
	public function dijkstra()
	{

	}

	/**
	 * 贪婪算法
	 * 一个州能覆盖多个广播站, 如何找出最少的州, 覆盖所有的广播站, 近似解.
	 *
	 * @param $states_needed
	 * @param $stations
	 * @return array
	 * @author lvzhiwei <im.lvzhiwei@gmail.com>
	 *
	 * 2021/7/14 17:58
	 */
	public function greed($states_needed=[], $stations=[])
	{
		$states_needed = ["a", "b", "c", "d", "e", "f", "g"]; //所需要的州
		$stations = [
			'kone' => ['a', 'b', 'c'],
			'ktwo' => ['a', 'd', 'e', 'f'],
			'kthree' => ['c', 'd', 'e', 'f', 'g'],
			'kfour' => ['a', 'd'],
			'kfive' => ['a', 'c'],
		]; //广播站对应的州

		$final_stations = []; //存储最终的集合

		while ($states_needed) {
			$best_stations = null;
			$states_covered = [];
			foreach ($stations as $station => $states_for_station)
			{
				$covered = array_intersect($states_needed, $states_for_station);
				if (count($covered) > count($states_covered))
				{
					$best_stations = $station;
					$states_covered = $covered; //本次foreach循环已覆盖的州
				}
			}

			$states_needed = array_diff($states_needed, $states_covered);
			$final_stations[] = $best_stations;
		}

		return $final_stations;
	}


}

