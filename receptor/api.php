<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

$data = file_get_contents(dirname(__FILE__).'/data.json');
$website_data = json_decode($data);

function getTextSample() {
	return '纽约法拉成样本文字形在用上述方法对文本提取了特征之后，如果我们直接将所有特征直接丢入分类器，那么最终训练得到的模型的效果往往并不尽如人意。特别是在模型的训练和预测速度上，由于经过多个特征提取和组合方法之后的特征空间会极度膨胀，模型需要学习的参数数量也因此暴涨，从而大大地增加了训练和预测过程的耗时。因此，在候选特征集合中选择保留最有效的部分就显得尤为重要。常用的特征选择方法有卡方检验和信息增益等。卡方检验的目的是计算每个特征对分类结果的相关性，相关性越大则越有助于分类器进行分类，否则就可以将其作为无用特征抛弃。卡方检验是一种常用的统计检验方法，但是其缺点在于仅考虑特征是否出现对于分类结果的影响，而忽略了词频的重要性，因此卡方检验往往夸大了低频词的作用。信息增益用来计算一个特征对整个分类系统带来的信息的多少，带来的信息越多意味着该特征对分类越重要。此外一些分类算法本身也有特征选择的作用，例如C4.5决策树就是采用信息增益的方法来计算最佳的划分特征、逻辑回归模型训练后可以得到特征权重等。值得一提的是，TF-IDF并不是一种真正意义上的特征选择方法。通过TF-IDF算法可以得到特征在每一篇文章中重要性，但是却没有考虑特征在类间的分布情况。也就是说，假如类别A中的所有文章都包含词t，类别B中均不包含，但可能由于类别A样本在总样本中占比较极高，原本显著的分类特征t却因为计算得到的TF-IDF值较小而被过滤掉了，这显然没有起到特征选择的目的。';
}

function get($source){
	global $website_data;
	return $website_data->{$source};
}

function __($source, $length=20){
	global $website_data;
	if(!isset($website_data->{$source})){
		echo substr(getTextSample(), 0, $length);
	}
	else{
		echo $website_data->{$source};
	}
}

function get_posts(){
	try{
		$data = file_get_contents(dirname(__FILE__).'/posts.json');
		$post_data = json_decode($data);
	}
	catch(Exception $ex){
		return false;
	}
	return $post_data;
}