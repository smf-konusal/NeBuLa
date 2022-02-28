<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines https://www.simplemachines.org
 * @copyright 2022 Simple Machines and individual contributors
 * @license https://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 2.1.0
 */

/**
 * The top part of the outer layer of the boardindex
 */
function template_boardindex_outer_above()
{
}

/**
 * This actually displays the board index
 */
function template_main()
{
	global $context, $txt, $scripturl,$settings,$user_info,$memberContext,$modSettings;
			$latestPostOptions = array(
				'number_posts' => !empty($settings['number_recent_posts']) ? $settings['number_recent_posts'] : 20,
			);
			$context['latest_posts'] = cache_quick_get('boardindex-latest_posts:' . md5($user_info['query_wanna_see_board'] . $user_info['language']), 'Subs-Recent.php', 'cache_getLastPosts', array($latestPostOptions));
		echo '<div id="topic_container">';
				foreach ($context['latest_posts'] as $post)
				{
				loadMemberData($post['poster']['id']);
				loadMemberContext($post['poster']['id']);
					echo '
						<div class="windowbg ">
						<a href="',$post['poster']['href'],'" class="board_icon">', !empty($memberContext[$post['poster']['id']]['avatar']['image']) ? $memberContext[$post['poster']['id']]['avatar']['image'] : '<img class="avatar" src="'.$modSettings['avatar_url'].'/default.png" alt="*" />' ,'</a>
						<a class="info" href="', $post['href'], '">
							
								<h3 class="mui--text-title">', $post['subject'], '</h3>
								<div class="mui--text-caption"><strong class="mui--text-black">', $post['poster']['name'], '</strong> <span class="mui--text-dark-secondary">', $post['time'], '</span></div>
								<div class="mui--text-caption">', $post['preview'], '</div>
							
						</a>
						<div class="lastpost mui--text-right">', $post['board']['link'], '</div>
						</div>';
				}		
		echo '	
			</div>';

}

/**
 * The lower part of the outer layer of the board index
 */
function template_boardindex_outer_below()
{
}

?>